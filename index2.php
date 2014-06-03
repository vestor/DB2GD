<?php

session_start();
set_time_limit(0);

ob_start();
require_once 'Google/Client.php';
require_once 'Google/Service/Drive.php';

DEFINE("TESTFILE", 'mainFile');
if (!file_exists(TESTFILE)) {
  $fh = fopen(TESTFILE, 'w');
  fwrite($fh, " ");
  fclose($fh);
}

 $client_id = '132057500632-enrut139h37p39fnfn40f7pukmtgptvb.apps.googleusercontent.com';
 $client_secret = '7vceJbqRx0CrEPzquyDJY9Le';
 $redirect_uri = 'http://db2gd.hol.es/index2.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/drive");
$service = new Google_Service_Drive($client);

if (isset($_REQUEST['logout'])) {
//  unset($_SESSION['upload_token ']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['upload_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  //echo($redirect);
  //header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
header("Location: http://db2gd.hol.es/index.php");	
}

if (isset($_SESSION['upload_token']) && $_SESSION['upload_token']) {
  $client->setAccessToken($_SESSION['upload_token']);
  if ($client->isAccessTokenExpired()) {
    unset($_SESSION['upload_token']);
  }
} else {

  $authUrl = $client->createAuthUrl();
  header('Location: '.$authUrl);	
}
/*
if ($client->getAccessToken())
{
	echo "Redirecting";
	header("Location: http://db2gd.hol.es/index.php");	
}
*/

if (($client->getAccessToken()) && (isset($_SESSION['action']))) {
  
  $file = new Google_Service_Drive_DriveFile();

  $path = "metadata.json";
  if(file_exists($path))
  {
   $json = json_decode(file_get_contents($path),true);  
   $filename = basename($json['path']);

  }
else
  {
   echo "No file from DropBox";
   ob_flush();	
   $filename = "noname.cpp";
  
   }
   echo($filename);	
  $file->title = $filename;

  $chunkSizeBytes = 1 * 1024 * 1024;

  // Call the API with the media upload, defer so it doesn't immediately return.
  $client->setDefer(true);
  $request = $service->files->insert($file);

  // Create a media file upload to represent our upload process.
  $media = new Google_Http_MediaFileUpload(
      $client,
      $request,
      'text/plain',
      null,
      true,
      $chunkSizeBytes
  );
  
  $media->setFileSize(filesize('mainFile'));

  // Upload the various chunks. $status will be false until the process is
  // complete.
  $status = false;
  $handle = fopen('mainFile', "rb");
//  echo "Uploading";
//  ob_flush();
  while (!$status && !feof($handle)) {
    $chunk = fread($handle, $chunkSizeBytes);
    $status = $media->nextChunk($chunk);
  }

  // The final value of $status will be the data from the API for the object
  // that has been uploaded.
  $result = false;
  if ($status != false) {
    $result = $status;
	
 	//echo'<pre>';
	//print_r($result['md5Checksum']);	
	//echo '</pre>';
	if(!isset($_SESSION['checksum']))
	{
			$_SESSION['checksum'] = md5_file('mainFile');
	}

	if($result['md5Checksum'] == $_SESSION['checksum'])
	{
?>
	<br/>
	<br/>
<?php		
		echo"Done";
		ob_flush();
	}
	

	if(file_exists("mainFile"))
        {
 	 unlink("mainFile");
         unlink("metadata.json");
        }
    }

  fclose($handle);
}
ob_end_flush();
?>
<div class="box">
  <div class="request">
    <?php if (isset($authUrl)): ?>
      <a class='login' href='<?php echo $authUrl; ?>'>Connect Me!</a>
    <?php endif; ?>
  </div>

  </div>
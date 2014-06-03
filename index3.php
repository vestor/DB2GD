<?php
session_start();
set_time_limit(0);
ob_start();

require_once "dropbox-sdk/lib/Dropbox/autoload.php";

require_once "controller.php";

use \Dropbox as dbx;

$app = new Controller();
 
if(!$app->isAuthorized()){
	$authUrl = $app->getAuthUrl();
 
	if($authUrl){
		?>
		<script language="javascript" type="text/javascript">

		function popitup(url) {
			newwindow=window.open(url,'name','width=300, height=300');
newwindow.resizeTo(screen.availWidth,screen.availHeight);
			if (window.focus) {
                         
                         newwindow.focus();                         			         
                           }
			return false;
		}

		</script>
		Click <a href="<?php echo $authUrl ?>"  onclick="return popitup('<?php echo $authUrl ?>')">here</a><br />		
		Paste the code below, and hit Save<br /><br />
		<form method="post">
			<input type="text" name="auth_code">
			<input type="submit" value="Save" class="button" />
		</form>
		<?php
	}
} else {


	$accessToken = $_SESSION['access_token'];

	$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

/*	$folderMetadata = $dbxClient->getMetadataWithChildren("/");

echo "<pre>";
print_r($folderMetadata);
echo "</pre>";
*/
	if(isset($_SESSION['action']))
	{
	//echo "Searching for file..";
	//ob_flush();
	getFirstFile($dbxClient->getMetadata("/"),$dbxClient);
	
	}

	else
	{
	
	header("Location: http://db2gd.hol.es/index.php");	
	
	}
}


function getFirstFile($pMetaData,$dbClient)
{


	if( $pMetaData['is_dir'] != "1")
	{
	
		$fd = fopen("mainFile", "w+b");
		//echo "Found File\n";
		//echo basename($pMetaData['path']);
		//ob_flush();
 		$md = $dbClient->getFile($pMetaData['path'], $fd);
 		fclose($fd);
		
		$fp = fopen('metadata.json', 'w');
		fwrite($fp, json_encode($md));
		fclose($fp);
		$_SESSION['checksum'] = md5_file('mainFile');
		//echo($_SESSION['checksum']);
		return $pMetaData;		
	}
	else
	{
		$fMetaData = $dbClient->getMetadataWithChildren($pMetaData['path']);
		
		foreach($fMetaData['contents'] as $array_elem)
		{	
	
			return getFirstFile($array_elem,$dbClient);
		}
	}
	
}
ob_end_flush();
?>
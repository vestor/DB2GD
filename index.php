<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Mon Jun 02 2014 09:55:27 GMT+0000 (UTC) -->
<html data-wf-site="538b75fefedd28266051e508">
<head>
  <meta charset="utf-8">
  <title>DB2GD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/db2gd.webflow.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Droid Sans:400,700","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
  <link rel="apple-touch-icon" href="images/thumbnail-starter.png">

<script language="javascript" type="text/javascript">

function popitup(url) {
	newwindow=window.open(url,'name','height=200,width=150');
	if (window.focus) {newwindow.focus()}
	return false;
}


function popitup_copy() {
	newwindow=window.open('http://db2gd.hol.es/copy.php','name','height=200,width=150');
	if (window.focus) {newwindow.focus()}
	return false;
}

</script>
</head>
<body>

<?php

session_start();
?>
  <div>
    <div class="hero-bg">
      <div class="w-container">
        <h1 id="page-nav-Section-1">DropBox to Drive</h1>
        <div class="subtitle">A simple project to move a file from Dropbox to Drive account</div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="w-row">
      <div class="w-col w-col-6 w-col-small-6 w-col-tiny-6 column">
        <img class="imgleft" src="images/Dropbox-Logo.png" width="150" alt="538b805cfedd28266051e5cc_Dropbox-Logo.png">
      </div>
      <div class="w-col w-col-6 w-col-small-6 w-col-tiny-6 column">
        <img class="imgright" src="images/Logo_of_Google_Drive.png" width="150" alt="538b7fc313a46eb10628bf9b_Logo_of_Google_Drive.png">
      </div>
    </div>
<div class="w-row">
<?php

if(!isset($_SESSION['access_token']))
{

echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button_dropbox" href="http://db2gd.hol.es/index3.php"   >Connect</a>';
 echo '</div>';
}
else
{

echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button_dropbox" href="#" >Connected</a>';
 echo '</div>';
}

if(!isset($_SESSION['upload_token']))
{
echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button" href="http://db2gd.hol.es/index2.php"  >Connect</a>';
echo '</div>';
}
else
{
echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button" href="#"  >Connected</a>';
echo '</div>';
}
?>
      
    </div>
    <div class="w-row">
<?php

if(isset($_SESSION['access_token']))
{
 echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button_dropbox revoke" href="http://db2gd.hol.es/revoke_db.php" >Revoke</a>';
echo '</div>';
}
else
{
 echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button_dropbox revoke" href="#" >No Perms</a>';
echo '</div>';
}

if(isset($_SESSION['upload_token']))
{
 echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button revoke" href="http://db2gd.hol.es/revoke_gd.php" >&nbsp;&nbsp;Revoke</a>';
echo '</div>';

}
else
{
 echo '<div class="w-col w-col-6 w-col-small-6 w-col-tiny-6"><a class="button revoke" href="#" >&nbsp;&nbsp;No Perms</a>';
echo '</div>';

}

?>
    </div>
<?php
if(isset($_SESSION['upload_token']) && isset($_SESSION['access_token']))
{
    echo '<div><a id="copy" class="button button_copy" href="http://db2gd.hol.es/copy.php"  onclick="return popitup_copy()">Copy</a>';
    echo '</div>';
}
else
{
echo '<div><a class="button button_copy" href="#">Connect Drive and Dropbox First</a>';
    echo '</div>';
}
?>
  </div>
  <div class="content-bg two"></div>
  <div class="section">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-6 left-footer-col">
          <div class="footer-text">A crude but time consuming effort to a real world scenario :D</div>
        </div>
        <div class="w-col w-col-6 footer-nav-bar"></div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>
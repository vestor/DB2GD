<?php
// libs/Controller.php
class Controller {
	private $appInfo;
	private $webAuth;
 
	public function __construct(){
 
		$this->appInfo = Dropbox\AppInfo::loadFromJson(array(
			"key" => "vvrih8zyiiva1pg",
			"secret"=> "mmrsxvfq50wamzj"
		));
 
		$this->webAuth = new Dropbox\WebAuthNoRedirect($this->appInfo, "**IDENTIFIER**");
 
		if(isset($_POST['auth_code'])){
			$this->saveAuthorizationCode($_POST['auth_code']);
		}
	}
 
	public function isAuthorized(){
		return isset($_SESSION['access_token']);
	}
 
	public function getAuthUrl(){
		return $this->webAuth->start();
	}	
 
	private function saveAuthorizationCode($code){
		list($accessToken, $dropboxUserId) = $this->webAuth->finish($code);
 
		if($accessToken){
			$_SESSION['access_token'] = $accessToken;
		}
    }
}
?>
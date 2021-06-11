<?php 

require_once "Facebook/autoload.php";

$Fb= new \Facebook\Facebook([

  	'app_id' => '1213196662403487',
	'app_secret' => 'd677780897828a06d4aeeb5f68e49a5f',
	'default_graph_version' => 'v2.10',


]);
$helper = $Fb->getRedirectLoginHelper();
 // /$_SESSION['FBRLH_state']=$_GET['state'];
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
?>
<?php
session_start();
require_once('./setting_edit.php');
$userID = $_SESSION['userId'];
$screenName = $_SESSION['screenName'];

$wishID = htmlspecialchars($_POST["wishID"], ENT_QUOTES);

if(empty($wishID)){
	echo("error");
}else{
	addWishID($userID,$wishID);
}

header("Location: settings.php");
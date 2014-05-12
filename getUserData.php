<?php

if(!function_exists(accessPDO)){
	function accessPDO(){
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=amazon-wish','yooda2','fghjkl',
				array(PDO::ATTR_EMULATE_PREPARES => false));
		} catch (PDOException $e) {
			exit('接続できませんでした'.$e->getMessage());
		}
		return $pdo;
	}
}

function getUserArray(){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM user_table");
	$stmt->execute();
	$array = array();
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		$array[$row['userID']] = $row['screenName'];
	}
	return $array;
}

function getUserIDArray(){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM user_table");
	$stmt->execute();
	$array = array();
	$i = 0;
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		$array[$i] = $row['userID'];
		$i++;
	}
	return $array;
}

function getNamefromID($userID){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM user_table WHERE userID = :userID");
	$stmt->bindValue(':userID' , $userID , PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	return $row['screenName'];
}


function getWishArray($userID){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM wish_table WHERE userID = :userID");
	$stmt->bindValue(':userID' , $userID, PDO::PARAM_INT);
	$stmt->execute();
	$array = array();
	$i=0;
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		$array[$i] = $row['wishID'];
		$i++;
	}
	return $array;
}

function getWishCount($userID){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM wish_table WHERE userID = :userID");
	$stmt->bindValue(':userID',$userID,PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->rowCount();

}
<?php

function accessPDO(){
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=amazon-wish','yooda2','fghjkl',
			array(PDO::ATTR_EMULATE_PREPARES => false));
	} catch (PDOException $e) {
		exit('接続できませんでした'.$e->getMessage());
	}
	return $pdo;
}

function createUser($userId,$screenName){
	$pdo = accessPDO();
	$stmt = $pdo -> prepare("INSERT INTO user_table (userID,screenName) VALUES (:userID,:screenName)");
	$stmt->bindValue(':userID', $userId, PDO::PARAM_INT);
	$stmt->bindValue(':screenName', $screenName, PDO::PARAM_STR);
	$stmt->execute();
}



function addWishID($userID,$wishID){
	$pdo = accessPDO();
	$stmt = $pdo -> prepare("INSERT INTO wish_table (userID,wishID) VALUES (:userID,:wishID)");
	$stmt->bindValue(':userID',$userID,PDO::PARAM_INT);
	$stmt->bindValue(':wishID',$wishID,PDO::PARAM_STR);
	$stmt->execute();
}


function isUserExist($userID){
	$pdo = accessPDO();
	$stmt = $pdo->prepare("SELECT * FROM user_table WHERE userID = :userID");
	$stmt->bindValue(':userID',$userID,PDO::PARAM_INT);
	$stmt -> execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($row['id'])){
		return true;
	}else{
		return false;
	}
}

function deleteWishID($userID,$wishID){
	$pdo = accessPDO();
	$stmt = $pdo -> prepare("DELETE FROM wish_table WHERE wishID = :wishID AND userID = :userID");
	$stmt->bindValue(':wishID',$wishID,PDO::PARAM_STR);
	$stmt->bindValue(':userID',$userID,PDO::PARAM_INT);
	$stmt->execute();
}


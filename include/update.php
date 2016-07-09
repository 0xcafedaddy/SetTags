<?php
	
	$info = $_POST['info'];
	$res = json_decode($info);

	$uuid = $res->uuid;
	$tags =  $res->tags;
	$custom_tag =  $res->custom_tag;

    include 'db.php';
    $pdo = new PDO($dsn, $userName, $psw);
    $query = "update topic set tags = '$tags' ,custom_tag = '$custom_tag' where uuid = '$uuid'";

    //执行SQL语句
	$result = $pdo->prepare($query);
	$result->execute();
	$code = $result->errorCode();

?>
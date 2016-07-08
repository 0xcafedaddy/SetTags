<?php
	
	$info = $_POST['info'];
	$res = json_decode($info);

	$uuid = $res->uuid;
	$tags =  $res->tags;
	$level =  $res->level;

    include 'db.php';
    $pdo = new PDO($dsn, $userName, $psw);
    $query = "update topic set tags = '$tags' ,level = '$level' where uuid = '$uuid'";

    //执行SQL语句
	$result = $pdo->prepare($query);
	$result->execute();
	$code = $result->errorCode();

?>
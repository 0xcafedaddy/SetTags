<?php
	
	$info = $_POST['info'];
	$res = json_decode($info);

	$uuid = $res->uuid;
	$tags =  $res->tags;
	$level =  $res->level;

	//连接数据库
    // $dbms = "mysql";//选择数据库类型，MySQL
    // $host = "127.0.0.1"; //选择服务器
    // $userName = "wp";//用户名
    // $psw = "mkit";
    // $dbName = "test";//数据库名称
    // $dsn = "$dbms:host=$host;dbname=$dbName";
    include 'db.php';

    $pdo = new PDO($dsn, $userName, $psw);
    $query = "update topic set tags = '$tags' ,level = '$level' where uuid = '$uuid'";


    //执行SQL语句
	$result = $pdo->prepare($query);
	$result->execute();
	$code = $result->errorCode();

?>
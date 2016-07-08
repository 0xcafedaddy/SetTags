<?php
    $uuid = $_GET['uuid'];

    //连接数据库
    // $dbms = "mysql";//选择数据库类型，MySQL
    // $host = "127.0.0.1"; //选择服务器
    // $userName = "wp";//用户名
    // $psw = "mkit";
    // $dbName = "test";//数据库名称
    // $dsn = "$dbms:host=$host;dbname=$dbName";
    include 'db.php';

    $pdo = new PDO($dsn, $userName, $psw);
    $query = "select keywords from topic where uuid = '$uuid'";
    $request = $pdo->prepare($query);
    $request->execute();
    $res = $request->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h4><?php echo $res[0]['keywords']?></h4>
</body>
</html>



    
    





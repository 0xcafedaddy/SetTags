<?php
	
    $start = $_GET['start'];
    $length = $_GET['length'];
    $draw = $_GET['draw'];

    //条件过滤后记录数 必要
    $recordsFiltered = 0; 
    //表的总记录数 必要
    $recordsTotal = 0;

    //连接数据库
    $dbms = "mysql";//选择数据库类型，MySQL
    $host = "127.0.0.1"; //选择服务器
    $userName = "wp";//用户名
    $psw = "mkit";
    $dbName = "test";//数据库名称
    $dsn = "$dbms:host=$host;dbname=$dbName";
    //include 'db.php';
    
    $pdo = new PDO($dsn, $userName, $psw);
    $total = "select count(uuid) total from topic";  
    $req = $pdo->prepare($total);
    $req->execute();
    $resTotal = $req->fetchAll(PDO::FETCH_ASSOC);
    $recordsTotal = $resTotal[0]['total'];

    $query = "select author,title,app_category,content,keywords,add_time,domain,image_count,uuid,tags,level from topic limit {$start},{$length}";
    $request = $pdo->prepare($query);
    $request->execute();
    $res = $request->fetchAll(PDO::FETCH_ASSOC);

    $Data = array();

    for($i = 0 ; $i <count($res); $i++){ 
        $Data[$i]['author'] = $res[$i]['author'];
        $Data[$i]['title'] = $res[$i]['title'];
        $Data[$i]['app_category'] = $res[$i]['app_category'];
        $Data[$i]['keywords'] = $res[$i]['keywords'];
        $Data[$i]['add_time'] = $res[$i]['add_time'];
        $Data[$i]['domain'] = $res[$i]['domain'];
        $Data[$i]['image_count'] = $res[$i]['image_count'];
        $Data[$i]['uuid'] = $res[$i]['uuid'];
        $Data[$i]['tags'] = $res[$i]['tags'];
        $Data[$i]['level'] = $res[$i]['level'];
    }
    $output['draw'] = $draw;
    $output['iTotalRecords'] = $recordsTotal;
    $output['recordsFiltered'] = $recordsTotal;
    $output['aaData'] = $Data;
	$json =  json_encode($output);
	echo $json;
?>
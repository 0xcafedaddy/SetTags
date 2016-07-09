<?php
	
    $start = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];



    $query = "select author,title,app_category,content,keywords,add_time,domain,image_count,uuid,tags,custom_tag from topic order by add_time desc limit {$start},{$length}"; 

    $condition = "1 = 1 ";

    if(!empty($_POST['uuid'])){
        $uuid = $_POST['uuid'];
        $condition = $condition." and "."uuid = '".$uuid."'";
    }

    if(!empty($_POST['domain'])){
        $domain = $_POST['domain'];
        $condition = $condition." and "."domain like '%".$domain."%'";
    }

    if(!empty($_POST['title'])){
        $title = $_POST['title'];
        $condition = $condition." and "."title like '%".$title."%'";
    }

    if(!empty($_POST['author'])){
        $author = $_POST['author'];
        $condition = $condition." and "."author like '%".$author."%'";
    }

    if(!empty($_POST['tags'])){
        $tags = $_POST['tags'];
        $condition = $condition." and "."tags like '%".$tags."%'";
    }

    if(!empty($_POST['postDateStart'])){
        $postDateStart = $_POST['postDateStart'];
        $condition = $condition." and "."add_time >= '".$postDateStart."'";
    }

    if(!empty($_POST['postDateEnd'])){
        $postDateEnd = $_POST['postDateEnd']; 
        $condition = $condition." and "."add_time <= '".$postDateEnd."'";
    }


    if(!empty($_POST['uuid']) || !empty($_POST['domain'])  ||  !empty($_POST['title'])  ||  !empty($_POST['author'])  || !empty($_POST['tags'])  ||  !empty($_POST['postDateStart']) || !empty($_POST['postDateEnd']) ){

        $query = "select author,title,app_category,content,keywords,add_time,domain,image_count,uuid,tags,custom_tag from topic where {$condition}  order by add_time desc limit {$start},{$length}";
    }


    //条件过滤后记录数 必要
    $recordsFiltered = 0; 
    //表的总记录数 必要
    $recordsTotal = 0;

    //连接数据库
    include 'db.php';
    
    $pdo = new PDO($dsn, $userName, $psw);
    $total = "select count(uuid) total from topic where {$condition}";  
    $req = $pdo->prepare($total);
    $req->execute();
    $resTotal = $req->fetchAll(PDO::FETCH_ASSOC);
    $recordsTotal = $resTotal[0]['total'];

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
        $Data[$i]['custom_tag'] = $res[$i]['custom_tag'];
    }
    $output['draw'] = $draw;
    $output['iTotalRecords'] = $recordsTotal;
    $output['recordsFiltered'] = $recordsTotal;
    $output['aaData'] = $Data;
	$json =  json_encode($output);
	echo $json;
?>
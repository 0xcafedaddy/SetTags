<?php
    $uuid = $_GET['uuid'];
    include 'db.php';
    $pdo = new PDO($dsn, $userName, $psw);
    $query = "select title,content,keywords from topic where uuid = '$uuid'";
    $request = $pdo->prepare($query);
    $request->execute();
    $res = $request->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    body {
    margin:0 px;
    padding:0 px;
     letter-spacing: -0.2px;
    background-color:#f7f7f7;
}
.container{
    padding:0px;
    margin:0px;
}
.title{
font-family: Roboto-Bold;
    font-size: 24px;
    font-weight: bold;
    color: #21212121;
    line-height:32px;
    /*line-height:125%;*/
    margin-bottom:20px;
    margin-top:12px;
}
.info{
    line-height:18px;
    font-size:12px;
    color:#999999;

}
div.info span{
    margin-right:20px;
}

a:link {
color:#3b75b8;
text-decoration:none;

}
a:visited {
color:#3b75b8;
text-decoration:none;
}

img {
    border: none;
    width: 100%;
    padding:0px;
    margin:0px;
    height: auto;
    -ms-interpolation-mode: bicubic;
    display: block;
    margin-top:24px;
    margin-bottom:24px;
}
figure{
    margin:0px;
    padding:0px;
}
div.content{
    color:#212121;
    font-size:16px;
    line-height:24px;
    font-family:Roboto-Condensed;
    word-space:3px;

}

.content.p{
    margin-top:24px;
    margin-bottom:24px;

}
:-webkit-any(article,aside,nav,section) :-webkit-any(article,aside,nav,section) :-webkit-any(article,aside,nav,section) h1 {
    font-size: 1em;
    -webkit-margin-before: 1.33em;
    -webkit-margin-after: 1.33em;
}

:-webkit-any(article,aside,nav,section) :-webkit-any(article,aside,nav,section) h1 {
    font-size: 1.17em;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
}

:-webkit-any(article,aside,nav,section) h1 {
    font-size: 1.5em;
    -webkit-margin-before: 0.83em;
    -webkit-margin-after: 0.83em;
}


@font-face {
  font-family: Roboto-Bold;

}
@font-face {
  font-family: Roboto-Regular;

}
</style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable>=no">
</head>
<body>
<div class="container">

<div class="title"><?php echo $res[0]['title']?> </div>
<div class="info"><span class="domain"></span>
            <span class="author"></span>
             <span class="post_time"></span>
              <a class="view_source"></a>
</div>
<div class="content">
     <?php echo $res[0]['content']?> 
</div>
</div>
</body>
</html>
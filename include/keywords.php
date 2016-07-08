<?php
    $uuid = $_GET['uuid'];
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



    
    





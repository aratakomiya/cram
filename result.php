<?php
$host = 'mysql';
$user = 'root';
$passwd = 'root';
$dbname = 'practice';
$err_msg=[];
$words=[];

$link=mysqli_connect($host,$user,$passwd,$dbname);
if($link === FALSE){
   print 'DB接続失敗';
   exit;
}

mysqli_set_charset($link,'utf8');

if(isset($_POST["words"])){
 
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
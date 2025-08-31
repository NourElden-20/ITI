<?php
$servername='localhost';
$username='root';
$password='';
$DB='market';
$options=[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC

];

try{
    $conn= new PDO("mysql:host=$servername;dbname=$DB",$username,$password,$options);
    

}

catch(PDOException $e){
     echo "Connection failed: " . $e->getMessage();

}










?>
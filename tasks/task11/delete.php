<?php
include "DBconnection.php";

// $stat=$conn->prepare("SELECT product_id FROM products");
// $stat->execute();
// $result=$stat->fetchAll();
// var_dump($result);
if(!isset($_GET['id'])){
    echo "badd";
    exit();
}
$id=$_GET['id'];
$query=$conn->prepare("DELETE FROM products WHERE product_id =:id");
$result=$query->execute([
    ":id"=>$id
]);

header("location: index.php");

?>
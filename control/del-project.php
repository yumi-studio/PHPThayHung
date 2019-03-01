<?php
session_start(); 
include "database.php";
$pid = $_POST['id'];
$query="DELETE from project where id=$pid";
$stmt=$db->prepare($query);
if($stmt->execute()){
    echo "Delete Project OK";
}else{
    echo "Delete Project Fail";
}
?>
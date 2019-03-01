<?php
include "database.php";
$query = "SELECT * from project where id={$_POST['id']}";
$stmt=$db->prepare($query);
if($stmt->execute()){
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}
?>
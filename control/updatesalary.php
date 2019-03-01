<?php
$id = (int) $_POST['id'];
$bonus = (int) $_POST['bonus'];
$fines = (int) $_POST['fines'];

include "database.php";
$query = "UPDATE salary SET bonus=$bonus,fines=$fines where id=$id";
$stmt=$db->prepare($query);
$stmt->execute();
if($stmt->execute()){
    echo "OK";
    print_r($stmt);
}else{
    print_r($stmt);
}

?>
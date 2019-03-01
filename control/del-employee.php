<?php
    session_start();
    if(isset($_SESSION['status'],$_GET['id']) && $_SESSION['status']==1){
        include "database.php";
        $id=$_GET['id'];
        $query="DELETE FROM account WHERE id = {$_GET['id']}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        // if($stmt->execute()){
        //     echo "OK";
        // }else{
        //     echo "fail";
        // }
        // print_r($stmt);
    }
?>
<?php
    session_start();
    if(isset($_GET['regis']) && isset($_GET['id'])){
        $pid = $_GET['id'];
        $uid=$_SESSION['id'];
        include "database.php";
        $query="INSERT INTO register (accountId,projectId) VALUES (:a,:p)";
        $query2="DELETE FROM register WHERE projectId={$pid} AND accountId={$uid}";
        if($_GET['regis']=='true'){
            // echo $query;
            $stmt=$db->prepare($query);
            $stmt->bindParam(":a",$uid);
            $stmt->bindParam(":p",$pid);
            $stmt->execute();
        }else{
            // echo $query2;
            $stmt=$db->prepare($query2);
            $stmt->execute();
        }
    }
    header("location: ../project-register.php");
    
    
?>
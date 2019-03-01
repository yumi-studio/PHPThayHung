<?php
    include "database.php";
    if(isset($_POST['mode']) and $_POST['mode']==1){
        $query = "INSERT into project(name,location,description,start,finsh) values(?,?,?,?,?)";
        $stmt= $db->prepare($query);
        $stmt->bindParam(1,$_POST['pname']);
        $stmt->bindParam(2,$_POST['ploc']);
        $stmt->bindParam(3,$_POST['pdesc']);
        $stmt->bindParam(4,$_POST['pstart']);
        $stmt->bindParam(5,$_POST['pend']);
        $stmt->execute();
        print_r($stmt);
    }
    if(isset($_POST['mode']) and $_POST['mode']==2){
        $query = "UPDATE project set name=?,location=?,description=?,start=?,finsh=? where id={$_POST['pid']}";
        $stmt= $db->prepare($query);
        $stmt->bindParam(1,$_POST['pname']);
        $stmt->bindParam(2,$_POST['ploc']);
        $stmt->bindParam(3,$_POST['pdesc']);
        $stmt->bindParam(4,$_POST['pstart']);
        $stmt->bindParam(5,$_POST['pend']);
        $stmt->execute();
        print_r($stmt);
    }
?>
<?php
    $host="localhost";
    $user="root";
    $pass="";
    $dbname="baitaplon";
    
    try {
        $db= new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$user,$pass);
    } catch (PDOException $ex) {
        //throw $th;
        echo $ex->getMessage();
    }
?>
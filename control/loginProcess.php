<?php
    session_start();
    if(isset($_POST['btnLogin'])){
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];

        require "database.php";
        $query = "SELECT id,name,status,branch_id FROM account WHERE userName=:u AND password=:p LIMIT 0,1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':u',$username);
        $stmt->bindParam(':p',$password);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        if($count>0){
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            // if($row['password']==$password){
                $_SESSION['name']=$row['name'];
                $_SESSION['status']=$row['status'];
                $_SESSION['id']=$row['id'];
                $_SESSION['branch_id']=$row['branch_id'];
                if($row['status']==0){
                    header('location: ../employee.php');
                }else{
                    header('location: ../profile.php');
                }
                
            // }else{
            //     header('location: ../login.php');
            // }
            
        }else{
            header('location: ../login.php');
        }
    }else{
        header('location: ../login.php');
    }
?>
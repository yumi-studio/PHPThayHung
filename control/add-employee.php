<?php
        $txtuser=$_POST['txtuser'];
        $txtpass=$_POST['txtpass'];
        $txtname=$_POST['txtname'];
        $txtaddr=$_POST['txtaddr'];
        $txtemail=$_POST['txtemail'];
        $txtphone=$_POST['txtphone'];
        $txtbranch=$_POST['txtbranch'];
        $txtrole=$_POST['txtrole'];
        switch ($txtrole) {
            case '1':
                # code...
                $roletxt='Giám đốc';
                $money=10000;
                break;
            case '2':
                # code...
                $roletxt='Thư kí';
                $money=2000;
                break;
            case '3':
                # code...
                $roletxt='Trưởng phòng';
                $money=5000;
                break;
            case '4':
                $roletxt = 'Nhân viên';
                $money=500;
                break;
            default:
                # code...
                break;
        }
        include "database.php";
        if(isset($_POST['btnadd'])){
            $query="INSERT into account(userName,password,name,address,email,phone,branch_id,position,status) values(:a,:b,:c,:d,:e,:f,:g,:h,:i)";
            $stmt=$db->prepare($query);
            $stmt->bindParam(':a',$txtuser);
            $stmt->bindParam(':b',$txtpass);
            $stmt->bindParam(':c',$txtname);
            $stmt->bindParam(':d',$txtaddr);
            $stmt->bindParam(':e',$txtemail);
            $stmt->bindParam(':f',$txtphone);
            $stmt->bindParam(':g',$txtbranch);
            $stmt->bindParam(':h',$roletxt);
            $stmt->bindParam(':i',$txtrole);
            $stmt->execute();
            print_r($stmt);



            $query="SELECT id FROM account order by id desc limit 1";
            $stmt=$db->prepare($query);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
            $query="INSERT into salary(accountId,fixed_salary) values(?,?)";
            $stmt=$db->prepare($query);
            $stmt->bindParam(1,$row['id']);
            $stmt->bindParam(2,$money);
            $stmt->execute();
        }else{
            if(isset($_POST['btnupdate'])){
                $query="UPDATE account set userName='$txtuser',password='$txtpass',name='$txtname',address='$txtaddr',email='$txtemail',
                phone='$txtphone',branch_id=$txtbranch,position='$roletxt',status=$txtrole where id={$_POST['id']}";
                $stmt=$db->prepare($query);
                // $stmt->bindParam(':a',$txtuser);
                // $stmt->bindParam(':b',$txtpass);
                // $stmt->bindParam(':c',$txtname);
                // $stmt->bindParam(':d',$txtaddr);
                // $stmt->bindParam(':e',$txtemail);
                // $stmt->bindParam(':f',$txtphone);
                // $stmt->bindParam(':g',$txtbranch);
                if($stmt->execute()){
                    echo "OK";
                }else{
                    echo "FAIL".$query;
                }
            }
        }

    // header("location: ../employee.php")
?>
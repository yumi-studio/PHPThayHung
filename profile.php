<?php
    ob_start();
    require "header.php";
    $buffer=ob_get_contents();
    ob_end_clean();
    $title="Thông tin cá nhân";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
    $id;
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id=$_SESSION['id'];
    }

    require "navigator.php";
    ?>
    <!-- Main -->
        <div id="main" class="container-fluid bg-secondary">
            <div class="row">
                <div class="col-sm-3" id="profile-nav">
                    <?php include "navigator2.php"?>
                </div>
                <div class="col-sm-5" id="content">
                    <div class="card">
                        <?php
                            include "control/database.php";
                            $query="SELECT * from account where id={$id}";
                            $stmt=$db->prepare($query);
                            $stmt->execute();
                            $row=$stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="card-body border-bottom">
                            <h5 class="card-title">Họ và tên</h5>
                            <p class="card-text"><?php echo $row['name']?></p>
                        </div>
                        <div class="card-body border-bottom">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text"><?php echo $row['email']?></p>
                        </div>
                        <div class="card-body border-bottom">
                            <h5 class="card-title">Số điện thoại</h5>
                            <p class="card-text"><?php echo $row['phone']?></p>
                        </div>
                        <div class="card-body border-bottom">
                            <h5 class="card-title">Địa chỉ</h5>
                            <p class="card-text"><?php echo $row['address']?></p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Vị trí công tác</h5>
                            <p class="card-text"><?php echo $row['position']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" id="avatar">
                    <div class="card">
                        <div class="card-body">
                            <div id="frame">
                                <img src="image/avatar.png" alt="Đây là avatar">
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <form action="control/changeAvatar.php" method="post" enctype='multipart/form-data'>
                                <div class="input-group">
                                    <input type="file" name="image" id="" class="form-control">
                                    <input type="submit" value="Lưu thay đổi" class="btn btn-success w-100">
                                </div>
                            </form>
                            <script>
                                
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    require "footer.php";
?>
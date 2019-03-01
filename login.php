<?php
    session_start();
    if(isset($_GET['lang']) ){
        $_SESSION['lang']=$_GET['lang'];
    }else{
        if(!isset($_SESSION['lang'])){
            $_SESSION['lang']="en";
        }
    }
    
    if(isset($_SESSION['status'])){
        header('location: profile.php');
    }else
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/layout.css">
</head>
<body class="bg-light login" style="">
    <form action="control/loginProcess.php" method="POST" id="login-form" class="text-light shadow-lg">
        <h4 class="card-title"><?php echo($_SESSION['lang']=="en"?"Welcome to TDTECH!":"Chào mừng đến với TDTECH!")?></h4>
        <div class="form-group">
            <label for=""><?php echo($_SESSION['lang']=="en"?"Username":"Tên đăng nhập")?></label>
            <input type="text" name="txtUsername" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for=""><?php echo($_SESSION['lang']=="en"?"Password":"Mật khẩu")?></label>
            <input type="password" name="txtPassword" id="" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="<?php echo($_SESSION['lang']=="en"?"Login":"Đăng nhập")?>" class="btn btn-danger" name="btnLogin">
        </div>
        <div class="form-group">
            <select name="lang" id="" onchange="langChange()" class="form-control">
                <?php
                if($_SESSION['lang']=="en"){
                    echo '<option value="0" selected hidden>----------Select Language----------</option>
                    <option value="en">English</option>
                    <option value="vn">Vietnamese</option>';
                }
                if($_SESSION['lang']=="vn"){
                    echo '<option value="0" selected hidden>----------Chọn ngôn ngữ----------</option>
                    <option value="en">Tiếng anh</option>
                    <option value="vn">Tiếng việt</option>';
                }
                ?>
                
            </select>
        </div>
    </form>
    <script>
    function langChange(){
        var x = $('[name=lang]').val();
        console.log(x);
        if(x!=0) document.location.href="/phpthayhung/login.php?lang="+x;
    }
    </script>
</body>
</html>


    

    

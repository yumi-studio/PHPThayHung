
<!-- Navigator -->
    <div id="navigator" class="bg-dark" >
        <div class="container-fluid navbar navbar-expand-lg navbar-dark">
            <ul class="navbar-nav" style="width:100%">
                    <?php
                    if(isset($_SESSION['status'])){
                        ?>
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="profile.php"><?php echo $_SESSION['name'];?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger" href="control/logoutProcess.php">Đăng xuất</a>
                        </li>
                        <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
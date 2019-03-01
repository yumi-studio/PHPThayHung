<ul class="nav flex-column bg-dark rounded navbar-dark nav-pills nav-fill" style="padding:5px" id="navigator2">
    <li class="nav-item"><a href="profile.php" class="nav-link text-light">Thông tin cá nhân</a></li>
    <!-- <li class="nav-item"><a href="project-register.php" class="nav-link text-light">Danh sách dự án</a></li> -->
    <li class="nav-item"><a href="salary.php" class="nav-link text-light"><?php echo($_SESSION['status']==1?"Bảng chấm công":"Bảng lương")?></a></li>
    <?php
    if($_SESSION['status']==0 or $_SESSION['status']==1){
        ?>
        <li class="nav-item"><a href="employee.php" class="nav-link text-light">Quản lý nhân viên</a></li>
        <?php
    }
    ?>
</ul>
<script>
$(document).ready(()=>{
    $('#navigator2 a[href="'+location.pathname.split('/')[2]+'"]').addClass("active");
})
</script>
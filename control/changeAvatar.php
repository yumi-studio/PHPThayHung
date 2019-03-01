<?php
$image = $_FILES['image'];
move_uploaded_file($image['tmp_name'],"../image/avatar.png");
header("location: ../profile.php");
?>
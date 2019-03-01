
<div class="card">
    <div class="card-header">
        <form class="float-left form-inline">
            <label for="">Sắp xếp theo:</label>
            <select name="sortmode" id="" class="form-control ml-3" onchange="sorting()">
                <option value="-1" hidden>---------------</option>
                <option value="0" selected >A-Z</option>
                <option value="1">Z-A</option>
                <option value="2">Ngày bắt đầu</option>
                <option value="3">Vị trí</option>
                <option value="4">Số lượng thành viên tham gia</option>
            </select>
            <div class="form-check ml-3">
                <input type="radio" name="reg[]" id="" class="form-check-input" value="0" onclick="sorting()" checked>
                <label for="" class="form-check-label">Đã đăng ký</label>
            </div>
            <div class="form-check ml-3">
                <input type="radio" name="reg[]" id="" class="form-check-input" value="1" onclick="sorting()">
                <label for="" class="form-check-label">Chưa đăng ký</label>
            </div>
        </form>
        <?php
        session_start();
        if($_SESSION['status']==1){
            echo('<button type="button" data-toggle="modal" data-target="#addProjectForm" class="btn btn-dark float-right">Thêm dự án</button> ');
        }
        ?>
           
    </div>
<?php
    include "database.php";

    $query="SELECT * from project";
    $stmt=$db->prepare($query);
    $stmt->execute();

    $query2="SELECT projectId from register where accountId={$_SESSION['id']}";
    $stmt2=$db->prepare($query2);
    $stmt2->execute();         
    $registed = $stmt2->fetchAll();
    $count = $stmt2->rowCount();
    function isRegister($x,$y){
        foreach ($y as $key => $value) {
            if($x==$value[0]){
                return true;
            }
        }
        return false;
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
        <div class="card-body border-bottom">
            <div class="row">
                <div class="col-sm-3">
                    <h5 class="card-title">Tên dự án</h5>
                    <p class="card-text"><?php echo $row['name']?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-title">Thời gian dự kiện</h5>
                    <p class="card-text"><?php echo explode(" ",$row['start'])[0]."->".explode(" ",$row['finsh'])[0];?></p>
                </div>
                <div class="col-sm-6">
                    <h5 class="card-title">Mô tả</h5>
                    <p class="card-text"><?php echo $row['description']?></p>
                </div>
                <div class="col-sm-12" style="padding-top:20px">
                    <?php
                        if(isRegister($row['id'],$registed)){
                    ?>
                        <a href="control/project-register.php?<?php echo "id=".$row['id']."&regis=false"?>"><button class="btn btn-warning">Hủy đăng ký</button></a>
                    <?php
                        }else{
                    ?>
                        <a href="control/project-register.php?<?php echo "id=".$row['id']."&regis=true"?>"><button class="btn btn-success">Đăng ký</button></a>
                    <?php
                        }
                    ?>
                    <button class="btn btn-info" onclick="showMember(<?php echo $row['id']?>)" data-toggle="modal" data-target="#memberList">Thành viên tham gia</button>
                    <?php
                    if($_SESSION['status']==1){
                        ?>
                        <button class="btn btn-dark" onclick="takeProjectData(<?php echo $row['id']?>)" data-toggle="modal" data-target="#updateProjectForm">Sửa thông tin</button>
                        <button class="btn btn-danger" onclick="deleteProject(<?php echo $row['id']?>)">Hủy dự án</button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
?>
</div>
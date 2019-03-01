<?php
session_start();
include "database.php";
$mode=$_GET['mode'];
$reg=$_GET['reg'];
$path = "";
$path2 = "";
if($reg=='0'){
    $path2 = "WHERE project.id IN (SELECT distinct projectId from register where accountId={$_SESSION['id']})";
}else{
    $path2 = "WHERE project.id NOT IN (SELECT distinct projectId from register where accountId={$_SESSION['id']})";
}

function isRegister($x,$y){
    foreach ($y as $key => $value) {
        if($x==$value[0]){
            return true;
        }
    }
    return false;
}
switch ($mode) {
    case '0':
        $path="SELECT * FROM project ".$path2." order by name ASC";
        break;
    case '1':
        $path="SELECT * FROM project ".$path2." order by name DESC";
        break;
    case '2':
        $path="SELECT * FROM project ".$path2." order by start DESC";
        break;
    case '3':
        $path="SELECT * FROM project ".$path2." order by location ASC";
        break;
    case '4':
        $path="SELECT project.*,count(register.projectId) as counter FROM project LEFT JOIN register ON project.id=projectId ".$path2." group by project.id ORDER BY counter DESC";
        break;
    default:
        $path="SELECT * FROM project order by id DESC ".$path2;
        break;
}

$stmt=$db->prepare($path);
if($stmt->execute()){
    $query2="SELECT projectId from register where accountId={$_SESSION['id']}";
    $stmt2=$db->prepare($query2);
    $stmt2->execute();         
    $registed = $stmt2->fetchAll();

    if($stmt2->rowCount()==0 && $reg=='0') echo '<div class="card-body">Chưa đăng ký project</div>';

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
}
?>
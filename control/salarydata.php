<?php
session_start();
include "database.php";

if($_POST['mode']=="mysalary"){
    $query="SELECT * from salary where accountId={$_SESSION['id']}";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="card-body border-bottom">
        <h5 class="card-title">Lương cơ bản</h5>
        <p class="card-text">$<?php echo $row['fixed_salary']?></p>
    </div>
    <div class="card-body border-bottom">
        <h5 class="card-title">Lương hoa hồng</h5>
        <p class="card-text">$<?php echo $row['bonus']?></p>
    </div>
    <div class="card-body border-bottom">
        <h5 class="card-title">Số lỗi phạt</h5>
        <p class="card-text"><?php echo $row['fines']?></p>
    </div>
    <div class="card-body">
        <h5 class="card-title">Tổng lương</h5>
        <p class="card-text">$<?php echo ((int)$row['fixed_salary']+(int)$row['bonus']-(int)$row['fines']*1234);?></p>
    </div>
    <?php
}else{
    // Lấy danh sách lương
    $query2 = "SELECT salary.id as sid,name,fixed_salary,bonus,fines from salary,account where account.id=salary.accountId and account.username<>'admin'";
    $stmt2=$db->prepare($query2);
    $stmt2->execute();

    echo '<table class="table table-bordered table-striped" style="table-layout: fixed">'.'<thead><tr><th>Họ và tên</th><th>Cơ bản</th><th>Điểm thưởng</th><th>Điểm trừ</th><th>Tổng cộng</th></tr></thead><tbody>';
    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){

        //CT Tính lương
        $total = $row['fixed_salary']+$row['bonus']*1000-$row['fines']*500;
    ?>
        <tr id="<?php echo $row['sid']?>">
            <td><?php echo $row['name']?></td>
            <td id="fs"><?php echo $row['fixed_salary']?></td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend"><input class="btn" type="button" value="-" name="-" onclick="decrease(this)"></div>
                    <input class="form-control" type="text" name="bonus" id="" value="<?php echo $row['bonus']?>">
                    <div class="input-group-append"><input class="btn" type="button" value="+" name="+" onclick="increase(this)"></div>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend"><input class="btn" type="button" value="-" onclick="decrease(this)"></div>
                    <input class="form-control" type="text" name="fines" id="" value="<?php echo $row['fines']?>">
                    <div class="input-group-append"><input class="btn" type="button" value="+" onclick="increase(this)"></div>
                </div>
            </td>
            <td><?php echo $total?></td>
        </tr>
    <?php
    }
    echo '</tbody></table>';
}
?>

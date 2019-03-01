
    <?php
        session_start();
        include "database.php";
        switch ($_SESSION['status']) {
            case '1':
                # code...
                $query="SELECT account.* FROM account LEFT JOIN branch ON branch.id={$_SESSION['branch_id']} WHERE status<>0 and branch_id={$_SESSION['branch_id']} ORDER BY account.branch_id";
                break;
            case '0':
                $query="SELECT account.* FROM account LEFT JOIN branch ON branch.id={$_SESSION['branch_id']} ORDER BY account.branch_id";
            default:
                # code...
                break;
        }
        
        $stmt=$db->prepare($query);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td class="align-middle"><?php echo $row['name']?></td>
                <td class="align-middle"><?php echo $row['branch_id']==1?"Miền Bắc":($row['branch_id']==2?"Miền Trung":"Miền Nam")?></td>
                <td class="align-middle"><?php echo $row['position']?></td>
                <td class="btn-group text-light">
                    <a href="profile.php?id=<?php echo $row['id']?>" class="btn btn-info">Chi tiết</a>
                    <a type="" data-toggle="modal" data-target="#updateModal" class="btn btn-warning" onclick="setEdit(<?php echo $row['id']?>)">Sửa</a>
                    <a onclick="deleteAccount(<?php echo $row['id']?>)" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php
        }
    ?>
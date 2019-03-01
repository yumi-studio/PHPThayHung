
<?php
include "database.php";
$query="SELECT userName from account,register where account.id=register.accountId and projectId={$_POST['id']}";
$stmt=$db->prepare($query);
if($stmt->execute()){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<p>".$row['userName']."</p>";
    }
}
?>
<?php
    include "database.php";
    $query="SELECT * FROM account where id={$_POST['id']}";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>
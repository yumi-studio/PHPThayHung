<?php
$q =  $_GET['q'];
include "database.php";
$query = "SELECT id,name FROM account WHERE name like '%$q%'";
$stmt=$db->prepare($query);
$stmt->execute();
$result="";
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<a href='profile.php?id={$row["id"]}' class='dropdown-item'>".$row['name']."</a>";
}
?>
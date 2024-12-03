<?php

include "config.php";
$id = mysqli_real_escape_string($conn, $_POST['cat_id']);
$fname = mysqli_real_escape_string($conn, $_POST['cat_name']);

$sql1 = "UPDATE category SET category_name = '{$fname}' WHERE category_id = {$id}";
if (mysqli_query($conn, $sql1)) {
    header("Location:{$hostname}/admin/category.php");
}

?>

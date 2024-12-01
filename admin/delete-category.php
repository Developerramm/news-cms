<?php 

include "config.php";

$id = mysqli_real_escape_string($conn,$_GET['id']);

$sql = "DELETE FROM category WHERE category_id = {$id}";

if(mysqli_query($conn,$sql)){
    header("Location:{$hostname}/admin/category.php");
}
mysqli_close($conn);


?>
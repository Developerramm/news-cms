<?php
include "config.php";
$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql = "SELECT * FROM post WHERE post_id = {$post_id}";

$result = mysqli_query($conn,$sql) or die("Query Failed");

$row = mysqli_fetch_assoc($result);

unlink("upload/".$row['post_img']);

$sql1 = "DELETE FROM post WHERE post_id = {$post_id};";

$sql1 .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";

if(mysqli_multi_query($conn,$sql1)){
    header("Location:{$hostname}/admin/post.php");
}
mysqli_close($conn);
?>
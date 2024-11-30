<?php


include 'config.php';
$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$fname = mysqli_real_escape_string($conn,$_POST['f_name']);
$lname = mysqli_real_escape_string($conn,$_POST['l_name']);
$user = mysqli_real_escape_string($conn,$_POST['username']);
$role = mysqli_real_escape_string($conn,$_POST['role']);

$sql1 = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}',username = '{$user}', role = '{$role}' WHERE user_id = {$id}";

if(mysqli_query($conn,$sql1)){
    header("Location:http://localhost/news/admin/users.php");
}
?>
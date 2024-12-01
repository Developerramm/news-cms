<?php

include "config.php";

if(isset($_FILES['fileToUpload'])){

    $errors = array();

    $filename = $_FILES['fileToUpload']['name'];
    $size = $_FILES['fileToUpload']['size'];
    $tmp = $_FILES['fileToUpload']['tmp_name'];
    $type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$filename));
    
    $extension = array("jpeg","jpg","png");

    if(in_array($file_ext,$extension) === false){
        $errors[] = "File extension does not match";
    }

    if($size > (2087152 * 10)){
        $errors[] = "File size must be 20MB or less";
    }

    if(empty($errors) == true){
        move_uploaded_file($tmp,"upload/".$filename);
    }else{
        die("File does not upload");
    }
}

$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);

$date = date("d M, Y");

session_start();
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post (title,description,category,post_date,author, post_img)  
VALUES 
('{$title}','{$description}',{$category},'{$date}',{$author},'{$filename}');";

$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

if(mysqli_multi_query($conn,$sql)){
    header("Location:{$hostname}/admin/post.php");
}else{
    echo "<div class = 'alert alert-danger'>Post does not save</div>";
}

mysqli_close($conn);


?>
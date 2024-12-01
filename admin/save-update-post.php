<?php
include "config.php";

if (empty($_FILES['new-image']['name'])) {

    $filename = $_POST['old-image'];
} else {
    $errors = array();

    $filename = $_FILES['new-image']['name'];
    $size = $_FILES['new-image']['size'];
    $tmp = $_FILES['new-image']['tmp_name'];
    $type = $_FILES['new-image']['type'];
    $ext1 = explode('.', $filename);
    $file_ext = end($ext1);
    $extension = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extension) === false) {
        $errors[] = "File extension does not match";
    }
    if ($size > (2087152 * 10)) {
        $errors[] = "File size must be 20MB or less";
    }
    if (empty($errors) == true) {
        move_uploaded_file($tmp, "upload/" . $filename);
    } else {
        die("File does not upload");
    }
}


$sql = "UPDATE post SET 
title = '{$_POST['post_title']}',
description = '{$_POST['postdesc']}',
category = {$_POST['category']},
post_img = '{$filename}' 
WHERE post_id = {$_POST['post_id']}";

if(mysqli_query($conn,$sql)){
    header("Location:{$hostname}/admin/post.php");
}

mysqli_close($conn);

?>

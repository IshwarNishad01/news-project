<?php

include('config.php');

if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
} else {

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];

    $destination = 'upload/' . $file_name;



    //  check file size 2 mb
    if ($file_size > 2097152) {
        $erros[] = "file must be 2mb or lower";
    }

    // move uploaded files into folder
    if (empty($erros) == true) {
        move_uploaded_file($file_tmp, $destination);
    } else {
        print_r($erros);
        die();
    }
}

$sql = "UPDATE post SET `title` ='{$_POST['post_title']}', `description`='{$_POST['postdesc']}', `category`='{$_POST['category']}', `post_img`='{$destination}' WHERE `post_id`={$_POST['post_id']} ";

$result = mysqli_query($conn, $sql);
if ($result) {
    header('location: http://localhost/news-site/admin/post.php');
} else {
    echo "Query Failed";
}

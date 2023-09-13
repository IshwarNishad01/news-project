<?php
include('config.php');

$category_id = $_GET['cid'];
echo $category_id;

$sql1 = "DELETE FROM category WHERE category_id = {$category_id}";
$result1 = mysqli_query($conn, $sql1);


if ($result1) {
    header('location: http://localhost/news-site/admin/category.php');
}

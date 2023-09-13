<?php include "header.php";
if ($_SESSION['role'] == 0) {
    header('location: http://localhost/news-site/admin/post.php');
}
?>
<div id="admin-content">
    <div class="container">

        <?php
        if (isset($_POST['save'])) {
            include('config.php');
            $sql = "INSERT INTO `category`( `category_name`, `post`) VALUES ('{$_POST['cat']}','0')";
            $result = mysqli_query($conn, $sql);
            if($result){
                header('location: http://localhost/news-site/admin/category.php');
            }else{
                echo "<div>can't insert new category</div>";
            }
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php

include('config.php');

$user_id = $_GET['uid'];

$sql2 = "SELECT * FROM user WHERE user_id = {$user_id}";
$result2 = mysqli_query($conn, $sql2) or die("Query Failed");
$row3 = mysqli_fetch_assoc($result2);
?>
<h2 class='page-heading'>Author Name - <?php if($row3['username'] == "ishu01"){ echo "Admin"; }else{ echo $row3['username'];}  ?></h2>
<?php


$limit = 3;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM post
LEFT JOIN category ON post.category = category.category_id
LEFT JOIN user ON post.author = user.user_id
WHERE user.user_id = {$user_id}
ORDER BY post.post_id DESC LIMIT {$offset},{$limit};
";

$result = mysqli_query($conn, $sql) or die("Failed Query");

if (mysqli_num_rows($result) > 0) {


?>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row);

    ?>

                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/<?php echo $row['post_img'] ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?uid=<?php echo $row['user_id'] ?>'><?php if($row['username']=="ishu01"){ echo "Admin";}else{echo $row['username'];} ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $row['description'] ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 

}}
?>

<?php
                    $sql1 = "SELECT * FROM post WHERE author = {$user_id}";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                    if (mysqli_num_rows($result1) > 0) {
                        $total_record = mysqli_num_rows($result1);

                        $totalPage = ceil($total_record / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="author.php?uid=' . $user_id .  '&page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $totalPage; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo '<li class="' . $active . '"><a href="author.php?uid=' . $user_id .  '&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($page < $totalPage) {
                            echo '<li><a href="author.php?uid=' . $user_id .  '&page=' . ($page + 1) . '">Next</a></li>';
                        }

                        echo '</ul>';
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>

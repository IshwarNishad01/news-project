
<?php
                session_start();
                include('config.php');
                if (isset($_POST['submit'])) {
                    $erros = array();
        

    

                    $file_name = $_FILES['fileToUpload']['name'];
                    $file_size = $_FILES['fileToUpload']['size'];
                    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
                    $file_type = $_FILES['fileToUpload']['type'];
                    // $file_ext = end(explode('.', $file_name));
                    $extenstion = array("jpeg", "png", "jpg");
                    $destination = 'upload/'.$file_name ;
                    print_r($_FILES);
                        // if (in_array($file_ext, $extenstion) === false) {
                        //     $erros[] = "This extension file is not allowed, please choose jpeg,png or jpg files";
                        // }

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
               

                // fetch data from user
                $title = mysqli_real_escape_string($conn, $_POST['post_title']);
                $postdesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $date = date("d M, Y");
                $autor = $_SESSION['user_id'];

                $sql = "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('{$title}','{$postdesc}',{$category},'{$date}',{$autor},'{$destination}');";

                $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

                if (mysqli_multi_query($conn, $sql)) {
                    header('location: http://localhost/news-site/admin/post.php');
                 
                } else {
                    echo "<div class='alert alert-danger'>Query Failed</div>";
                  
                }
            }


                ?>
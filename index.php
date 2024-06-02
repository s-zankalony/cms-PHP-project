<?php
include "includes/header.php";
// include "includes/db.php";
?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                CMS Application
                <small>Explore Latest Posts</small>
            </h1>

            <?php

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * 5) - 5;
            }






            $query = "SELECT * FROM posts WHERE post_status = 'published' limit $page_1, 5";

            $searchQuery = mysqli_query($connection, $query);
            $num_posts = mysqli_num_rows($searchQuery);
            // $count = ceil($num_posts / 5);
            
            if ($num_posts == 0) {
                echo "<h1 class='text-center'>No Post Available</h1>";
            } else {

                while ($row = mysqli_fetch_assoc($searchQuery)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_status = $row['post_status'];
                    $post_content = substr($row['post_content'], 0, 100);
                    $post_views = $row['post_views'];


                    ?>


                    <!-- First Blog Post -->



                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author.php?author=<?php echo urlencode($post_author); ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <p><span class="glyphicon glyphicon-eye-open"></span> Views <?php echo $post_views; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
                    </a>
                    <hr>

                    <p><?php echo $post_content; ?></p>

                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <?php
                }
            }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- pages -->
    <ul class="pager">
        <?php
        for ($i = 1; $i <= $num_posts; $i++) {

            if ($i == $page) {
                echo "<li ><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
        ?>
    </ul>

    <!-- Footer -->
    <?php
    include "includes/footer.php"
        ?>
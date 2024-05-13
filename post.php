<?php
include "includes/header.php";
include "includes/db.php";
include "admin/functions.php";
?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id = $post_id";

            $searchQuery = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($searchQuery)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>


                <h1 class="page-header">
                    Post Page
                    <small>Explore Full Post</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
                <hr>

                <p><?php echo $post_content; ?></p>


                <hr>

                <?php

            }
            ?>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <?php
            if (isset($_POST['submit'])) {
                $comment_content = $_POST['comment-content'];
                $comment_author = $_POST['comment-author'];
                $comment_post_id = $post_id;
                $comment_email = $_POST['comment-email'];

                $addComment = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($comment_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                $addCommentQuery = mysqli_query($connection, $addComment);
                confirmQuery($addCommentQuery);

                $queryUpdateCommentCount = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                $updateCommentCount = mysqli_query($connection, $queryUpdateCommentCount);
                confirmQuery($updateCommentCount);

                header("Location: post.php?p_id=$post_id#comment-well");
            }
            ?>
            <div class="well" id="comment-well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="comment-author">Author</label>
                        <input type="text" class="form-control" name="comment-author"
                            placeholder="Insert your name..." />
                    </div>
                    <div class="form-group">
                        <label for="comment-email">Email</label>
                        <input type="email" class="form-control" name="comment-email"
                            placeholder="Insert your email..." />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment-content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $commentQuery = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";

            $commentQuery = mysqli_query($connection, $commentQuery);
            while ($row = mysqli_fetch_assoc($commentQuery)) {
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
                ?>



                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
            <?php } ?>
            <!-- Comment -->
            <!-- <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                    Cras purus odio,
                    vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                    fringilla. Donec lacinia
                    congue felis in faucibus. -->
            <!-- Nested Comment -->
            <!-- <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                            commodo. Cras purus
                            odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                            vulputate fringilla.
                            Donec lacinia congue felis in faucibus.
                        </div>
                    </div> -->
            <!-- End Nested Comment -->
            <!-- </div> -->
            <!-- </div> -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php
    include "includes/footer.php"
        ?>
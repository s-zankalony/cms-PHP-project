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


      <?php

      if (isset($_GET['author'])) {
        $post_author = $_GET['author'];
        $post_author = urldecode($post_author);
      }


      $query = "SELECT * FROM posts WHERE post_author = '$post_author'";

      $searchQuery = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($searchQuery)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 100);
        ?>


        <h1 class="page-header">
          CMS Application
          <small>Explore Latest Posts by <?php echo $post_author; ?></small>
        </h1>

        <!-- First Blog Post -->
        <h2>
          <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
          by <a href="index.php"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
        <hr>

        <p><?php echo $post_content; ?></p>

        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
            class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        <?php

      }
      ?>


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
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
      $query = "SELECT * FROM posts WHERE post_status = 'published'";

      $searchQuery = mysqli_query($connection, $query);
      $num_posts = mysqli_num_rows($searchQuery);

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

  <!-- Footer -->
  <?php
  include "includes/footer.php"
    ?>
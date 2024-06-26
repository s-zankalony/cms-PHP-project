<?php

if (isset($_GET['p_id'])) {

  $the_post_id = $_GET['p_id'];
  $query = "SELECT posts.*, categories.cat_title FROM posts JOIN categories ON posts.post_category_id = categories.cat_id WHERE posts.post_id = $the_post_id ";
  $select_posts_by_id = mysqli_query($connection, $query);
}

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
  $cat_name = $row['cat_title'];
  $post_category_id = $row['post_category_id'];
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_status = $row['post_status'];
  $post_comments = $row['post_comment_count'];
  $post_views = $row['post_views'];
}

if (isset($_POST['update_post'])) {
  $post_title = $_POST['title'];
  $post_author = $_POST['author'];
  $post_category_id = $_POST['category_name'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_tags = $_POST['post_tags'];
  $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
  $post_date = date('Y-m-d H:i:s');
  // $post_comment_count = 4;
  $post_views = $_POST['post_views'];

  move_uploaded_file($post_image_temp, "../images/$post_image");



  if (empty($post_image)) {
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_image = mysqli_query($connection, $query);
    confirmQuery($select_image);

    while ($row = mysqli_fetch_array($select_image)) {
      $post_image = $row['post_image'];
    }
  }


  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_category_id = '{$post_category_id}', ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}', ";
  $query .= "post_image = '{$post_image}', ";
  $query .= "post_views = '{$post_views}' ";
  $query .= "WHERE post_id = {$the_post_id}";
  $update_post = mysqli_query($connection, $query);
  confirmQuery($update_post);
  echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";

}

if (isset($_POST['cancel'])) {
  header("Location: posts.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
  </div>

  <div class="form-group">
    <select name="category_name" id="">

      <?php
      $queryCat = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $queryCat);
      confirmQuery($select_categories);

      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_name = $row['cat_title'];
        $cat_id = $row['cat_id'];

        if ($cat_id == $post_category_id) {
          echo "<option value='{$cat_id}' selected>{$cat_name}</option>";
        } else {
          echo "<option value='{$cat_id}'>{$cat_name}</option>";
        }


      }

      ?>

    </select>

  </div>


  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
  </div>

  <div class="form-group">
    <label for="post_views">Post Views</label>
    <input type="text" class="form-control" name="post_views" value="<?php echo $post_views ?>" readonly>
    <input class="btn btn-primary" type="button" name="reset_views" value="Reset Views"
      onclick="document.getElementsByName('post_views')[0].value = '0'">
  </div>

  <div class="form-group">
    <select name="post_status" id="">

      <?php

      $postStatusQuery = "SELECT * FROM posts WHERE post_id = $the_post_id";
      $select_post_status = mysqli_query($connection, $postStatusQuery);
      confirmQuery($select_post_status);

      while ($row = mysqli_fetch_assoc($select_post_status)) {
        $post_status = $row['post_status'];
        if ($post_status == 'published') {
          echo "<option value='published' selected>Published</option>";
          echo "<option value='draft'>Draft</option>";
        } else {
          echo "<option value='published'>Published</option>";
          echo "<option value='draft' selected>Draft</option>";
        }
      }

      ?>

      <!-- <option value="draft">Post Status</option>
      <option value="published">Published</option>
      <option value="draft">Draft</option> -->
    </select>
  </div>



  <div class="form-group">

    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="summernote" cols="30"
      rows="10"><?php echo $post_content ?></textarea>
  </div>

  <!-- initialize summernote editor -->
  <script>
    $('#summernote').summernote({
      tabsize: 2,
      height: 100
    });
  </script>
  <!-- /initialize summernote editor -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
  </div>


</form>
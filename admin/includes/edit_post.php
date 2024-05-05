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
        // $cat_id = $row['cat_id'];
      
        echo "<option value='{$cat_name}'>{$cat_name}</option>";

      }

      ?>

    </select>

  </div>


  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">

  </div>
  <div class="form-group">
    <select name="post_status" id="">
      <option value="draft">Post Status</option>
      <option value="published">Published</option>
      <option value="draft">Draft</option>
    </select>
  </div>



  <div class="form-group">
    <label for="post_image">Post Image</label>
    <img src="../images/<?php echo $post_image ?>" width="100" alt="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="" cols="30" rows="10"><?php echo $post_content ?></textarea>
  </div>



  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Update Post">
  </div>


</form>
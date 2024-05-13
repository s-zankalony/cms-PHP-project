<?php
// include_once "../includes/db.php";
// include "../functions.php";

if (isset($_POST['create_post'])) {

  $post_title = $_POST['title'];
  $post_author = $_POST['author'];
  $post_category_id = $_POST['category_name'];
  $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];
  $post_date = date('Y-m-d H:i:s');


  move_uploaded_file($post_image_temp, "../images/$post_image");





  // $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
  // $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}')";

  // $create_post_query = mysqli_query($connection, $query);

  // confirmQuery($create_post_query);

  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
  $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "isssssss", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_status);
  mysqli_stmt_execute($stmt);

  if (!$stmt) {
    die("Query failed: " . mysqli_error($connection));
  }

  mysqli_stmt_close($stmt);


}

?>



<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
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

        echo "<option value='{$cat_id}'>{$cat_name}</option>";

      }

      ?>
    </select>
  </div>


  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author">

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
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="" cols="30" rows="10"
      placeholder="Insert content here..."></textarea>
  </div>




  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>


</form>
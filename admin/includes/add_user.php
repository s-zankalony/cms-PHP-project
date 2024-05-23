<?php
// include_once "../includes/db.php";
// include "../functions.php";

if (isset($_POST['add-user'])) {

  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  $user_role = $_POST['user_role'];
  $randSalt = $_POST['randSalt'];

  move_uploaded_file($user_image_temp, "../images/$user_image");

  $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role, randSalt) ";
  $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "ssssssss", $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $randSalt);
  mysqli_stmt_execute($stmt);

  if (!$stmt) {
    die("Query failed: " . mysqli_error($connection));
  }

  mysqli_stmt_close($stmt);

  header("Location: users.php");

}





?>



<form action="" method="post" enctype="multipart/form-data">



  <div class="form-group">
    <label for="title">User Name</label>
    <input type="text" class="form-control" name="user_name">
  </div>

  <div class="form-group">
    <label for="title">User Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <label for="author">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="author">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="author">User Email</label>
    <input type="email" class="form-control" name="user_email">


    <div class="form-group">
      <label for="post_image">User Image</label>
      <input type="file" name="user_image">
    </div>

    <div class="form-group">
      <label for="post_content">User Role</label>
      <select name="user_role" id="">
        <option value='user'>User</option>
        <option value='admin'>Admin</option>
      </select>
    </div>

    <div class="form-group">
      <label for="post_content">RandSalt</label>
      <input type="text" class="form-control" name="randSalt">
    </div>


    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="add-user" value="Add User">
    </div>


</form>
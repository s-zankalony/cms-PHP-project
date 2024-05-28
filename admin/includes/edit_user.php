<?php

if (isset($_GET['u_id'])) {
  $the_user_id = $_GET['u_id'];
  $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
  $select_user_by_id = mysqli_query($connection, $query);
}

while ($row = mysqli_fetch_assoc($select_user_by_id)) {
  $user_name = $row['user_name'];
  $user_password = $row['user_password'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_email = $row['user_email'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];
  $randSalt = $row['randSalt'];

}

if (isset($_POST['update_user'])) {
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  $user_role = $_POST['user_role'];
  $randSalt = $_POST['randSalt'];


  move_uploaded_file($user_image_temp, "../images/$user_image");



  if (empty($user_image)) {
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_image = mysqli_query($connection, $query);
    confirmQuery($select_image);

    while ($row = mysqli_fetch_array($select_image)) {
      $user_image = $row['user_image'];
    }
  }


  $query = "UPDATE users SET ";
  $query .= "user_name = '{$user_name}', ";
  $query .= "user_password = '{$user_password}', ";
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}', ";
  $query .= "user_email = '{$user_email}', ";
  $query .= "user_image = '{$user_image}', ";
  $query .= "user_role = '{$user_role}', ";
  $query .= "randSalt = '{$randSalt}' ";
  $query .= "WHERE user_id = {$the_user_id}";
  $update_user = mysqli_query($connection, $query);
  confirmQuery($update_user);
  echo "<p class='bg-success'>User Updated. <a href='../users.php?u_id={$the_user_id}'>View User</a> or <a href='users.php'>Edit More Users</a></p>";

}

if (isset($_POST['cancel'])) {
  header("Location: users.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
    <label for="title">User Name</label>
    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name ?>">
  </div>

  <div class="form-group">
    <label for="title">User Password</label>
    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
  </div>

  <div class="form-group">
    <label for="author">First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">

  </div>

  <div class="form-group">
    <label for="author">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
  </div>

  <div class="form-group">
    <label for="author">User Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
  </div>

  <div class="form-group">
    <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
    <input type="file" name="user_image">
  </div>

  <div class="form-group">
    <label for="post_content">User Role</label>
    <select name="user_role" id="">

      <?php

      if ($user_role === "admin" || $user_role === "Admin") {
        echo "<option value='admin' selected>Admin</option>";
        echo "<option value='user'>User</option>";
      } else {
        echo "<option value='user' selected>User</option>";
        echo "<option value='admin'>Admin</option>";

      }

      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_content">RandSalt</label>
    <input type="text" class="form-control" name="randSalt" value="<?php echo $randSalt ?>">
  </div>



  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
    <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
  </div>


</form>
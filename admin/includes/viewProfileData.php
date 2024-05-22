<?php


if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $query = "SELECT * FROM users WHERE user_id = $userId ";
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

?>


<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <img width="200" src="../images/<?php echo $user_image; ?>" alt="">

  </div>

  <div class="form-group">
    <label for="username">User Name: </label>
    <p class="form-control-static" name="username"><?php echo $user_name ?></p>
  </div>



  <div class="form-group">
    <label for="first-name">First Name</label>
    <p class="form-control-static" name="first-name"><?php echo $user_firstname ?></p>

  </div>

  <div class="form-group">
    <label for="last-name">Last Name</label>
    <p class="form-control-static" name="last-name"><?php echo $user_lastname ?></p>
  </div>

  <div class="form-group">
    <label for="author">User Email</label>
    <p class="form-control-static" name="user_email"><?php echo $user_email ?></p>
  </div>


  <div class="form-group">
    <label for="user-role">User Role</label>
    <p class="form-control-static" name="user-role"><?php echo $user_role ?></p>
  </div>

  <div class="form-group">
    <label for="randSalt">RandSalt</label>
    <p class="form-control-static" name="randSalt"><?php echo $randSalt ?></p>
  </div>



  <div class="form-group">
    <a href="editProfile.php"><input class="btn btn-primary" type="send" name="update_user" value="Update User"></a>
    <a href="../index.php"><input class="btn btn-primary" type="send" name="update_user" value="Back Home"></a>
  </div>


</form>
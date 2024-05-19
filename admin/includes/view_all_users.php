<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>User Id</th>
      <th>User Name</th>
      <th>User Password</th>
      <th>User First Name</th>
      <th>User Last Name</th>
      <th>User Email</th>
      <th>User Image</th>
      <th>User Role</th>
      <th>RandSalt</th>
      <th>Edit</th>
      <th>Delete</th>

    </tr>
  </thead>
  <tbody>
    <?php

    displayAllUsers();

    ?>

  </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
  $user_id = $_GET['delete'];

  $query = "DELETE FROM users WHERE user_id = {$user_id}";
  $delete_query = mysqli_query($connection, $query);
  confirmQuery($delete_query);

  header("Location: users.php");

}

// if (isset($_GET['approve_user'])) {
//   approveUser();
// }

// if (isset($_GET['unapprove'])) {
//   unapproveUser();
// }


?>
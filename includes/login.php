<?php include "db.php";
include "../admin/functions.php";
session_start();

if (isset($_POST['register'])) {
  header("Location: ../registration.php");
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);
  // hash password
  // $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


  $query = "SELECT * FROM users WHERE user_name = '{$username}'";
  $select_user_query = mysqli_query($connection, $query);

  if (!$select_user_query) {
    die("Query failed: " . mysqli_error($connection));
  }

  if (mysqli_num_rows($select_user_query) === 0) {
    echo "No such user";
    header("Location: ../index.php");
  }

  while ($row = mysqli_fetch_assoc($select_user_query)) {
    $db_user_id = $row['user_id'];
    $db_username = $row['user_name'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
  }




  if (password_verify($password, $db_user_password)) {

    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['firstName'] = $db_user_firstname;
    $_SESSION['lastName'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;




    if ($db_user_role !== 'admin') {
      header("Location: ../index.php");
    } else if ($db_user_role === 'admin') {
      header("Location: ../admin");
    } else {
      header("Location: ../index.php");
    }

  } else {

    session_destroy();
    header("Location: ../index.php");
  }



}

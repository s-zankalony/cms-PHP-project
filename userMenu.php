<?php




if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE user_name = '{$username}'";
  $select_user_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_user_query)) {
    $firstName = $row['user_firstname'];
    $lastName = $row['user_lastname'];
  }
  $fullName = $firstName . " " . $lastName;
}


?>
<ul class="nav navbar-right top-nav navbar-nav">

  <?php
  echo (basename($_SERVER['REQUEST_URI']) === 'admin' ? '<li><a href="../index.php">Home</a></li>' : '');
  ?>



  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
      <?php echo isset($fullName) ? $fullName : 'Logged Out'; ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li>
        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
      </li>

      <li class="divider"></li>
      <li>
        <a href="<?php echo $_SERVER['REQUEST_URI']; ?>?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
      </li>
  </li>
</ul>
</li>
</ul>
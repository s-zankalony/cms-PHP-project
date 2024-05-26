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
  if ((strpos($_SERVER['REQUEST_URI'], 'admin') !== false)) {
    echo "<li><a href='../index.php'>Home</a></li>";
  } else if ((strpos($_SERVER['REQUEST_URI'], '/') !== false) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    echo "<li><a href='admin'>Admin</a></li>";
  } else {
    echo '';
  }
  ?>



  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
      <?php echo isset($fullName) ? $fullName : 'Logged Out'; ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li>
        <a
          href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin') !== false) ? 'profile.php' : 'admin/profile.php'; ?>"><i
            class="fa fa-fw fa-user"></i> Profile</a>
      </li>

      <li class="divider"></li>
      <li>
        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $separator = (strpos($current_url, '?') === false) ? '?' : '&';
        ?>
        <a href="<?php echo $current_url . $separator; ?>logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

      </li>
      <!-- </li> -->
    </ul>
  </li>
</ul>
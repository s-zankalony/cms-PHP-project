<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">CMS Admin</a>
  </div>
  <!-- Top Menu Items -->
  <?php include '../userMenu.php'; ?>
  <!-- End top menu Items -->

  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li>
        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
      </li>

      <li class="<?php echo (basename($_SERVER['REQUEST_URI']) === 'posts.php' ? 'active' : ''); ?>">
        <a href="javascript:;" data-toggle="collapse" data-target="#posts-dropdown"><i class="fa fa-fw fa-arrows-v"></i>
          Posts
          <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="posts-dropdown" class="collapse">
          <li>
            <a href="posts.php">View All Posts</a>
          </li>
          <li>
            <a href="posts.php?source=add_post">Add Posts</a>
          </li>
        </ul>
      </li>
      <li class="<?php echo (basename($_SERVER['REQUEST_URI']) === 'categories.php' ? 'active' : ''); ?>">
        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
      </li>

      <li class="<?php echo (basename($_SERVER['REQUEST_URI']) === 'comments.php' ? 'active' : ''); ?>">
        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
      </li>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#user-dropdown"><i class="fa fa-fw fa-arrows-v"></i>
          Users
          <i class="fa fa-fw fa-caret-down"></i></a>

        <ul id="user-dropdown" class="collapse">
          <li>
            <a href="users.php">View All Users</a>
          </li>
          <li>
            <a href="users.php?source=add_user">Add Users</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
      </li>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
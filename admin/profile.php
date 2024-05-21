<?php include (__DIR__ . '/includes/adminHeader.php'); ?>



<body>

  <div id="wrapper">

    <!-- Navigation -->
    <?php include (__DIR__ . '/includes/adminNavigation.php') ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Profile Page
              <small><?php echo isset($firstName) ? $firstName : ''; ?></small>
            </h1>

            <?php
            include ('includes/viewProfileData.php');

            ?>

          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include (__DIR__ . '/includes/adminFooter.php'); ?>
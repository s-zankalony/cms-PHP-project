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
              All Comments Page
              <small>Author</small>
            </h1>

            <?php

            if (isset($_GET['source'])) {
              $source = $_GET['source'];
            } else {
              $source = '';
            }

            include ('includes/view_all_comments.php');

            ?>

          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include (__DIR__ . '/includes/adminFooter.php'); ?>
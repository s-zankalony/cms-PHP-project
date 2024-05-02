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
              Categories Page
              <small>Author</small>
            </h1>
            <div class="col-xs-6">

              <?php
              insertCategories();
              ?>

              <!-- add category form  -->
              <form method="POST" action="categories.php">
                <div class="form-group">
                  <label for="cat-title">Add Category</label>
                  <input class="form-control" type="text" name="cat-title">
                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
              </form> <!-- add category form  -->

              <?php

              if (isset($_GET['edit'])) {
                $cat_id = $_GET['edit'];
                include ('includes/updateCategories.php');

              }


              ?>

            </div>

            <div class="col-xs-6">


              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php // display all categories
                  findAllCategories();
                  ?>
                  <?php // delete category
                  deleteCategories();
                  ?>
                  <!-- <tr>
                    <td>1st category</td>
                    <td>PHP category</td>
                  </tr> -->

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include (__DIR__ . '/includes/adminFooter.php'); ?>
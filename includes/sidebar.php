<div class="col-md-4">




  <!-- Blog Search Well -->
  <div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="POST"> <!-- search form -->
      <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
          <button name="submit" class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form> <!-- /.search form -->
    <!-- /.input-group -->
  </div>




  <!-- Blog Categories Well -->

  <?php

  $query = "SELECT * FROM categories";
  $select_all_categories_sidebar = mysqli_query($connection, $query);
  ?>



  <div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled">
          <?php
          while ($row = mysqli_fetch_assoc($select_all_categories_sidebar)) {
            $cat_title = $row['cat_title'];
            echo "<li><a href='#'>{$cat_title}</a></li>";
          }
          ?>
          <!-- <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li> -->
        </ul>
      </div>
      <!-- /.col-lg-6 -->
      <!-- <div class="col-lg-6">
        <ul class="list-unstyled">
          <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li>
          <li><a href="#">Category Name</a>
          </li>
        </ul>
      </div> -->
      <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
  </div>

  <!-- Side Widget Well -->
  <?php include "widget.php"; ?>

</div>
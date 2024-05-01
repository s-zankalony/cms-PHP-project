<?php // edit category




if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];
  // include 'includes/updateCategories.php';
  $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
  $select_categories_id = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_categories_id)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];


    ?>


    <!-- update category form  -->
    <form method="POST" action="">
      <div class="form-group">
        <label for="cat-title">Update Category</label>
        <input class="form-control" type="text" name="cat-title" value="<?php if (isset($cat_title)) {
          echo $cat_title;
        } ?>">
      </div>
      <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
      </div>
    </form> <!-- update category form  -->

    <?php



  }

  if (isset($_POST['update'])) {
    $cat_title_update = $_POST['cat-title'];
    $updateQuery = "UPDATE categories SET cat_title = '{$cat_title_update}' WHERE cat_id = {$cat_id}";
    $update_query = mysqli_query($connection, $updateQuery);
    header("Location: categories.php");
    if (!$update_query) {
      die('QUERY FAILED' . mysqli_error($connection));
    }
  }

}




?>
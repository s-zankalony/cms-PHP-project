<?php

function insertCategories()
{

  global $connection;

  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat-title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "<p style='color: red;' >This field should not be empty</p>";
    } else {
      $createQuery = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
      $create_category_query = mysqli_query($connection, $createQuery);
      if (!$create_category_query) {
        die('QUERY FAILED' . mysqli_error($connection));
      }
    }
  }

}

function findAllCategories()
{
  global $connection;
  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}' >Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}' >Edit</a></td>";
    echo "<tr>";

  }
}

function deleteCategories()
{
  global $connection;
  if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $delQuery = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
    $delete_query = mysqli_query($connection, $delQuery);
    header("Location: categories.php");
  }
}

function displayAllPosts()
{
  global $connection;
  $query = "SELECT posts.*, categories.cat_title FROM posts JOIN categories ON posts.post_category_id = categories.cat_id";
  $select_posts = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_posts)) {
    $cat_name = $row['cat_title'];
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_comments = $row['post_comment_count'];
    echo "<tr>";
    echo "<td>{$post_id}</td>";
    echo "<td>{$post_author}</td>";
    echo "<td>{$post_title}</td>";
    echo "<td>{$cat_name}</td>";
    echo "<td>{$post_status}</td>";
    echo "<td>{$post_image}</td>";
    echo "<td>{$post_tags}</td>";
    echo "<td>{$post_comments}</td>";
    echo "<td>{$post_date}</td>";
    echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' >Edit</a></td>";
    echo "<td><a href='posts.php?delete={$post_id}' >Delete</a></td>";


  }
}

function confirmQuery($query)
{
  global $connection;
  if (!$query) {
    die("QUERY FAILED " . mysqli_error($connection));
  }

}


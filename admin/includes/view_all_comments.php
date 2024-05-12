<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>comment Id</th>
      <th>Post Title</th>
      <th>Comment Author</th>
      <th>Comment Email</th>
      <th>Comment Content</th>
      <th>Comment Status</th>
      <th>Comment Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php

    displayAllComments();

    ?>

  </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
  $the_post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
  $delete_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}


?>
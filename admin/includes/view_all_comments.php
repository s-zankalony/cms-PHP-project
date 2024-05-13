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
  $comment_id = $_GET['delete'];
  $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
  $delete_query = mysqli_query($connection, $query);
  header("Location: comments.php");
}

if (isset($_GET['approve_comment'])) {
  approveComment();
}

if (isset($_GET['unapprove'])) {
  unapproveComment();
}


?>
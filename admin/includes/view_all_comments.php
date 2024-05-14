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
  // Fetch the comment_post_id before deleting the comment
  $queryPostId = "SELECT comment_post_id FROM comments WHERE comment_id = $comment_id";
  $selectPostId = mysqli_query($connection, $queryPostId);
  confirmQuery($selectPostId);
  $row = mysqli_fetch_assoc($selectPostId);
  $postId = $row['comment_post_id'];

  // Now delete the comment
  $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
  $delete_query = mysqli_query($connection, $query);
  confirmQuery($delete_query);


  $queryDecreaseCommentCount = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $postId";
  $decreaseCommentCount = mysqli_query($connection, $queryDecreaseCommentCount);
  confirmQuery($decreaseCommentCount);

  header("Location: comments.php");
}

if (isset($_GET['approve_comment'])) {
  approveComment();
}

if (isset($_GET['unapprove'])) {
  unapproveComment();
}


?>
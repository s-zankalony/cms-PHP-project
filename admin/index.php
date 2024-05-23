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
                            Welcome to Admin
                            <small>
                                <?php echo isset($firstName) ? $firstName : ''; ?>
                            </small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                <?php
                // setting counts for posts, comments, users and categories
                
                $postsQuery = "SELECT * FROM posts";
                $postsResult = mysqli_query($connection, $postsQuery);
                $postsCount = mysqli_num_rows($postsResult);

                $draftPostsQuery = "SELECT * FROM posts WHERE post_status = 'draft'";
                $draftPostsResult = mysqli_query($connection, $draftPostsQuery);
                $draftPostsCount = mysqli_num_rows($draftPostsResult);

                $commentsQuery = "SELECT * FROM comments";
                $commentsResult = mysqli_query($connection, $commentsQuery);
                $commentsCount = mysqli_num_rows($commentsResult);

                $unapprovedCommentsQuery = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                $unapprovedCommentsResult = mysqli_query($connection, $unapprovedCommentsQuery);
                $unapprovedCommentsCount = mysqli_num_rows($unapprovedCommentsResult);

                $usersQuery = "SELECT * FROM users";
                $usersResult = mysqli_query($connection, $usersQuery);
                $usersCount = mysqli_num_rows($usersResult);

                $adminUsersQuery = "SELECT * FROM users WHERE user_role = 'admin'";
                $adminUsersResult = mysqli_query($connection, $adminUsersQuery);
                $adminUsersCount = mysqli_num_rows($adminUsersResult);

                $categoriesQuery = "SELECT * FROM categories";
                $categoriesResult = mysqli_query($connection, $categoriesQuery);
                $categoriesCount = mysqli_num_rows($categoriesResult);

                ?>

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $postsCount ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $commentsCount; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $usersCount; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $categoriesCount ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', { 'packages': ['bar'] });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                // data in the chart is an array of arrays
                                $elementText = ['Posts', 'draftPostsCount', 'Comments', 'Pending Comments', 'Users', 'Admins', 'Categories'];
                                $elementCount = [$postsCount, $draftPostsCount, $commentsCount, $unapprovedCommentsCount, $usersCount, $adminUsersCount, $categoriesCount];

                                for ($i = 0; $i < count($elementText); $i++) {
                                    echo "['{$elementText[$i]}',{$elementCount[$i]}],";
                                }

                                ?>
                                // ['Posts', 3],
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include (__DIR__ . '/includes/adminFooter.php'); ?>
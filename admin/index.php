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
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include (__DIR__ . '/includes/adminFooter.php'); ?>
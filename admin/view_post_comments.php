<?php include "../includes/db.php" ?>
<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Response To</th>
                                        <th>Date</th>
                                        <th>Author</th>
                                        <th>Email</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php findPostComments(); ?>

                                <?php approveComment(); ?>

                                <?php unapproveComment(); ?>

                                <?php deleteComment(); ?>

                                </tbody>

                            </table>
                        </div>

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php" ?>


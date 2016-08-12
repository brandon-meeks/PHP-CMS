<?php include "includes/admin_header.php" ?>
<!-- <?php include "functions.php" ?> -->


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
                    </div>
                </div>
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

                                    <?php 
                                        $query = "SELECT * FROM posts";
                                        $find_all_posts = mysqli_query($connection, $query);
                                        $post_count = mysqli_num_rows($find_all_posts);
                                    ?>
                                  <div class='huge'><?php echo $post_count ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Posts</span>
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

                                    <?php 
                                        $query = "SELECT * FROM comments";
                                        $find_all_comments = mysqli_query($connection, $query);
                                        $comment_count = mysqli_num_rows($find_all_comments);
                                    ?>

                                     <div class='huge'><?php echo $comment_count; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Comments</span>
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

                                    <?php 
                                        $query = "SELECT * FROM users";
                                        $find_all_users = mysqli_query($connection, $query);
                                        $user_count = mysqli_num_rows($find_all_users);
                                    ?>

                                    <div class='huge'><?php echo $user_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Users</span>
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

                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $find_all_categories = mysqli_query($connection, $query);
                                        $category_count = mysqli_num_rows($find_all_categories);
                                    ?>

                                        <div class='huge'><?php echo $category_count; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Categories</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                  ['', 'Published/Approved', 'Draft/Unapproved'],

                                  <?php 
                                    $query = "SELECT * FROM posts WHERE post_status = 'Published'";
                                    $find_published_posts = mysqli_query($connection, $query);
                                    $published_post_count = mysqli_num_rows($find_published_posts);
                                  ?>

                                  <?php 
                                    $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
                                    $find_draft_posts = mysqli_query($connection, $query);
                                    $draft_post_count = mysqli_num_rows($find_draft_posts);
                                  ?>

                                  <?php 
                                    $query = "SELECT * FROM users WHERE user_status = 'Approved'";
                                    $find_approved_users = mysqli_query($connection, $query);
                                    $active_user_count = mysqli_num_rows($find_approved_users);
                                  ?>

                                  <?php 
                                    $query = "SELECT * FROM users WHERE user_status = 'Unapproved'";
                                    $find_unapproved_users = mysqli_query($connection, $query);
                                    $unapproved_user_count = mysqli_num_rows($find_unapproved_users);
                                  ?>

                                  <?php 
                                    $query = "SELECT * FROM comments WHERE comment_status = 'Approved'";
                                    $find_approved_comments = mysqli_query($connection, $query);
                                    $approved_comment_count = mysqli_num_rows($find_approved_comments);
                                  ?>

                                  <?php 
                                    $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
                                    $find_unapproved_comments = mysqli_query($connection, $query);
                                    $unapproved_comment_count = mysqli_num_rows($find_unapproved_comments);
                                  ?>

                                  ['Posts', <?php echo $published_post_count; ?>, <?php echo $draft_post_count; ?>],
                                  ['Comments', <?php echo $approved_comment_count; ?>, <?php echo $unapproved_comment_count; ?>],
                                  ['Users', <?php echo $active_user_count; ?>, <?php echo $unapproved_user_count; ?>],
                                  ['Categories', <?php echo $category_count; ?>, 0]
                                ]);

                                

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php" ?>
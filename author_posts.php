<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/functions.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php

    if(isset($_GET['author'])) {

        $view_post_author = $_GET['author'];


?>

    <!-- Page Content -->
    <div class="container">
        <h1 class="page-header"><?php echo $view_post_author; ?>'s Posts </h1>

        <div class="row">
            <div class="col-md-8">
            <!-- Blog Post -->
                <?php



                
                $query = "SELECT * FROM posts WHERE post_author = '{$view_post_author}'";
                $select_all_posts = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($select_all_posts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                    ?>

                <h1>
                    <?php echo $post_title; ?>

                </h1>

               <!--  <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2> -->
                <!-- <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p> -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> </p>
                <p><span class="glyphicon glyphicon-user"></span> Posted by <?php echo $post_author; ?> </p>
                <hr>

                <?php 

                    if(empty($post_image)) {
                        echo "";
                    } else {
                        echo "<img class='img-responsive' src='images/{$post_image}' alt=''>";
                    }

                ?>
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <hr>
                    
              <?php } ?>

            <?php } ?>

                <hr>

 
            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
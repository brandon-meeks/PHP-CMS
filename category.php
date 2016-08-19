<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                
                <?php

                    if(isset($_GET['category'])) {

                        $post_cat_id = $_GET['category'];


                        $catQuery = "SELECT * FROM categories WHERE cat_id = $post_cat_id";
                        $select_category = mysqli_query($connection, $catQuery);

                        while($row = mysqli_fetch_assoc($select_category)) {
                            $cat_title = $row['cat_title'];
                        } 

                ?>

                <h1 class="page-header">
                    <?php echo $cat_title; ?> Posts
                </h1>

                <?php

                        $query = "SELECT * FROM posts WHERE post_category_id = {$post_cat_id} ";
                        $select_all_posts = mysqli_query($connection, $query);
                        $category_post_count = mysqli_num_rows($select_all_posts);

                        if(empty($category_post_count)) {
                            echo "<h3>There are no posts for this category.</h3>";
                        } else {
                        
                            while($row = mysqli_fetch_assoc($select_all_posts)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'], 0, 250);
                        
                            
                ?>
                
                            <!-- Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="#"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> </p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                            <hr>
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            
                            <hr>
                    
                        <?php } ?>

                        <!-- Pager -->
                        <ul class="pager">
                            <li class="previous">
                                <a href="#">&larr; Older</a>
                            </li>
                            <li class="next">
                                <a href="#">Newer &rarr;</a>
                            </li>
                        </ul>
                        
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
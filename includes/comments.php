                <!-- Blog Comments -->

                <?php createComment(); ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <input type="text" name="comment_author" placeholder="Your Name" required="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="comment_email" placeholder="you@example.com" required="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="comment_content" placeholder="Your Comment Here" required="true" class="form-control" rows="3"></textarea>
                        </div>
                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                    $comment_post_id = $_GET['p_id'];

                    $query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id} ";
                    $query .= "AND comment_status = 'Approved' ";
                    $query .= "ORDER BY comment_id DESC ";

                    $show_comments_query = mysqli_query($connection, $query);

                    if(!$show_comments_query) {

                        die('Query failed ' . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($show_comments_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_author = $row['comment_author'];
                        $comment_email = $row['comment_email'];
                        $comment_content = $row['comment_content'];

                        ?>


                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>

                    <?php } ?>



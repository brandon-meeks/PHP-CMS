<div class="table-responsive">

    <?php 

        if(isset($_POST['checkboxArray'])) {

            foreach ($_POST['checkboxArray'] as $checkboxValue) {
                
                $bulkOptions = $_POST['bulkOptions'];

                switch ($bulkOptions) {
                    case 'Published':
                        # code...
                        $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = $checkboxValue ";
                        $changePostToPublished = mysqli_query($connection, $query);

                        if(!$changePostToPublished) {

                            die('Post update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Post was published successfully!</div>";
            
                        }
                        break;

                    case 'Draft':
                        # code...
                        $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = $checkboxValue ";
                        $changePostToDraft = mysqli_query($connection, $query);

                        if(!$changePostToDraft) {

                            die('Post update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Post was unpublished successfully!</div>";
            
                        }
                        break;

                    case 'Delete':
                        # code...
                        $query = "DELETE FROM posts WHERE post_id = $checkboxValue ";
                        $deletePost = mysqli_query($connection, $query);

                        if(!$deletePost) {

                            die('Post update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Post deleted successfully!</div>";
            
                        }
                        break;

                    case 'Clone':
                        $query = "SELECT * FROM posts WHERE post_id = $checkboxValue ";
                        $selectPostQuery = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($selectPostQuery)) {
                            $post_title = $row['post_title'];
                            $post_cat_id = $row['post_category_id'];
                            $post_date = date('d-m-Y');
                            $post_author = $row['post_author'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_content = $row['post_content'];
                        }

                        $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_author, post_status, post_image, post_tags, post_content) ";
                        $query .= "VALUES({$post_cat_id}, '{$post_title}', now(), '{$post_author}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}') ";
                        $clonePostQuery = mysqli_query($connection, $query);

                        if(!$clonePostQuery) {
                            die("Post Cloning Failed! " . mysqli_error($connection));
                        } else {
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Posts were cloned successfully!</div>";
                        }
                        break;
                    
                    default: 
                        # code...
                        break;
                }

            }

        } else {
            $message = "";
        }





    ?>
    

    <form action="" method="post" name="bulkMethod">
        <?php echo $message; ?>

        <div id="bulkOptionsContainer">
            <div class="col-xs-2">
                <select name="bulkOptions" class="form-control">
                    <option value="">Select Option</option>
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
                    <option value="Clone">Clone</option>
                    <option value="Delete">Delete</option>
                </select>
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="?source=add_post" class="btn btn-primary">Add Post</a>
        </div>


        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox" name="selectAllBoxes"></th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php findAllPosts(); ?>

            <?php deletePost(); ?>

            </tbody>
        </table>
    </form>
</div>
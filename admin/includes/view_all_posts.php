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
            
                            echo "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
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
            
                            echo "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
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
            
                            echo "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Post deleted successfully!</div>";
            
                        }
                        break;
                    
                    default: 
                        # code...
                        break;
                }

            }

        }





    ?>
    

    <form action="" method="post" name="bulkMethod">

        <div id="bulkOptionsContainer">
            <div class="col-xs-2">
                <select name="bulkOptions" class="form-control">
                    <option value="">Select Option</option>
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
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
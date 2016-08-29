<?php include "includes/delete_modal.php"; ?>

<div class="table-responsive">

    <?php 

        if(isset($_POST['checkboxArray'])) {

            foreach ($_POST['checkboxArray'] as $checkboxValue) {
                
                $bulkOptions = $_POST['bulkOptions'];

                switch ($bulkOptions) {
                    case 'Published':
                        # code...
                        $query = "UPDATE pages SET page_status = 'Published' WHERE page_id = $checkboxValue ";
                        $changePageToPublished = mysqli_query($connection, $query);

                        if(!$changePageToPublished) {

                            die('Page update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Page was published successfully!</div>";
            
                        }
                        break;

                    case 'Draft':
                        # code...
                        $query = "UPDATE pages SET page_status = 'Draft' WHERE page_id = $checkboxValue ";
                        $changePageToDraft = mysqli_query($connection, $query);

                        if(!$changePageToDraft) {

                            die('Page update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Page was unpublished successfully!</div>";
            
                        }
                        break;

                    case 'Delete':
                        # code...
                        $query = "DELETE FROM pages WHERE page_id = $checkboxValue ";
                        $deletePost = mysqli_query($connection, $query);

                        if(!$deletePost) {

                            die('Page update failed ' . mysqli_error($connection));

                        } else {
            
                            $message = "<div class='alert alert-success alert-dismissible col-xs-4' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Page deleted successfully!</div>";
            
                        }
                        break;

                    case 'Clone':
                        $query = "SELECT * FROM pages WHERE page_id = $checkboxValue ";
                        $selectPageQuery = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($selectPostQuery)) {
                            $page_title = $row['page_title'];
                            $page_date = date('d-m-Y');
                            $page_author = $row['page_author'];
                            $page_status = $row['page_status'];
                            $page_image = $row['page_image'];
                            $page_content = $row['page_body'];
                        }

                        $query = "INSERT INTO page(page_title, page_date, page_author, page_status, page_image, page_body) ";
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

        <!-- Page bulk options -->

        <!-- <div id="bulkOptionsContainer">
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
            <a href="?source=add_page" class="btn btn-primary">Add Page</a>
        </div> -->


        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox" name="selectAllBoxes"></th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>View Count <a href="#">&nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="How many times this post has been viewed"></i></a></th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php findAllPages(); ?>

            <?php resetPostViews(); ?>

            <?php deletePost(); ?>

            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".delete_link").on('click', function() {
            var post_id = $(this).attr("rel");
            var post_delete_url = "posts.php?delete=" + post_id + " ";
            $(".delete_modal_link").attr("href", post_delete_url);

            $("#myModal").modal('show');
        });
        
    });
</script>
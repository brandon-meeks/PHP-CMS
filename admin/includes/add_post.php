<?php createPost(); ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_title">Post Category</label>
        <select name="post_category" id="">

        <?php

            $query = "SELECT *  FROM categories";
                            
            $edit_post_cat = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($edit_post_cat)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";

            }


        ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status">
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $_SESSION['username']; ?>">
    </div>

    <div class="form-group">
        <label for="post_title">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_title">Post Content</label>
        <textarea name="post_content" class="form-control" rows="10" cols="50"></textarea>
    </div>
    
    <div>
        <input type="submit" name="create_post" value="Create Post" class="btn btn-primary">
        <a href="posts.php" role="button" class="btn btn-default">Cancel</a>
    </div>

</form>
                

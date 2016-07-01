<?php createPost(); ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_title">Post Category</label>
        <input type="text" name="post_cat" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status" class="form-control">
            <option>Draft</option>
            <option>Published</option>
        </select>
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
    </div>

</form>
                

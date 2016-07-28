<?php

	// Find Post to Update

	if(isset($_GET['p_id'])) {

		$select_post_id = $_GET['p_id'];
	}

    $query = "SELECT *  FROM posts WHERE post_id = $select_post_id ";
    $select_posts_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_admin)) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_view_count = $row['post_view_count'];

    }

    // Update Post Query
    if(isset($_POST['update_post'])) {

    	$post_cat_id = $_POST['post_category'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        
        $post_image = $_FILES['post_image']['name'];
		$post_image_temp = $_FILES['post_image']['tmp_name'];

		$post_date = date('m-d-y');
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_view_count = $_POST['post_views'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {
        	$query = "SELECT * FROM posts WHERE post_id = $select_post_id ";
        	$select_image = mysqli_query($connection, $query);

        	while($row = mysqli_fetch_array($select_image)) {
        		$post_image = $row['post_image'];
        	}
        }


        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = {$post_cat_id}, ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$select_post_id} ";

        $update_post = mysqli_query($connection, $query);

        if(!$update_post) {

            die('Post update failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    Post was updated successfully!</div>";
            
        }

    }

 ?>

<!--  <?php resetPostViews(); ?> -->

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
    	<label>Category</label>
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
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" name="post_author" class="form-control" disabled>
    </div>
    
    <div class="form-group">
        <label for="post_status">Status</label>
        <select value="<?php echo $post_status; ?>" name="post_status">
            <option>Draft</option>
            <option>Published</option>
        </select>
    </div>

    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?>" alt="" width="100">
        <input type="file" name="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_title">Post Content</label>
        <textarea name="post_content" class="form-control" rows="10" cols="50"><?php echo $post_content; ?></textarea>
    </div>
    
    <div>
        <input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
    </div>

</form>
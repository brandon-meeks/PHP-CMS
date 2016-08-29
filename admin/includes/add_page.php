<?php createPage(); ?>

<div class="container">

	<form action="" method="POST" role="form" enctype="multipart/form-data">
		<legend>Create Page</legend>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="page_title">Title</label>
					<input type="text" class="form-control" name="page_title" id="page_title">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="page_author">Author</label>
					<input type="text" class="form-control" name="page_author" id="page_author" value="<?php echo $_SESSION['username']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group form-inline">
					<label for="page_status">Status</label>
			        <select name="page_status" class="form-control">
			            <option value="Draft">Draft</option>
			            <option value="Published">Published</option>
			        </select>
			    </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="page_image">Image</label>
					<input type="file" class="form-control" name="page_image" id="page_image">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="page_title">Body</label>
					<textarea class="form-control" name="page_body" id="page_body" rows="10" cols="70"></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="page_url">Page URL</label>
					<input type="text" class="form-control" name="page_url" id="page_url" placeholder="page-title">
				</div>
			</div>
		</div>

		<div>
        	<input type="submit" name="create_page" value="Create Page" class="btn btn-primary">
        	<a href="pages.php" role="button" class="btn btn-default">Cancel</a>
    	</div>


	</form>

</div>
<div class="table-responsive">
    

    <form action="" method="post" name="bulkMethod">

        <div class="col-xs-2">
            <select class="form-control">
                <option value="">Select Option</option>
                <option value="">Published</option>
                <option value="">Draft</option>
                <option value="">Delete</option>
            </select>
        </div>
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="?source=add_post" class="btn btn-primary">Add Post</a>


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
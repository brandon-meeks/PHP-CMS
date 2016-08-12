<div class="table-responsive">
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Response To</th>
                <th>Date</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php findPostComments(); ?>

        <?php approveComment(); ?>

        <?php unapproveComment(); ?>

        <?php deleteComment(); ?>

        </tbody>

        </tbody>

        </tbody>
    </table>
    </div>




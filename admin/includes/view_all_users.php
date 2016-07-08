


<div class="table-responsive">
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php findAllUsers(); ?>

        <?php approveUser(); ?>

        <?php unapproveUser(); ?>

        <?php deleteUser(); ?>

        </tbody>

    </table>
    </div>







<div class="table-responsive">
    <a href="?source=add_user" class="pull-left"><i class="fa fa-plus"></i> Add User</a>
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
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




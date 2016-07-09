<?php createUser(); ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" required="true" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" required="true" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_firstName">First Name</label>
        <input type="text" name="user_firstName" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastName">Last Name</label>
        <input type="text" name="user_lastName" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" required="true" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_title">User Image</label>
        <input type="file" name="user_image" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role">
            <option>Basic User</option>
            <option>Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_status">Status</label>
        <select name="user_status">
            <option>Approved</option>
            <option>Unapproved</option>
        </select>
    </div>
    
    <div>
        <input type="submit" name="create_user" value="Create User" class="btn btn-primary">
        <a href="users.php" role="button" class="btn btn-default">Cancel</a>
    </div>

</form>
                

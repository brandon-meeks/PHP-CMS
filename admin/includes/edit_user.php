<?php 

    if(isset($_GET['user_id'])) {

        $select_user_id = $_GET['user_id'];
    }

    // Find user to edit
    $query = "SELECT *  FROM users WHERE user_id = $select_user_id ";
    $select_users_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_admin)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstName = $row['user_firstName'];
        $user_lastName = $row['user_lastName'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];

    }

?>

<?php updateUser(); ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" required="true" value="<?php echo $username; ?>" class="form-control">
    </div>

<!--     <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" required="true" class="form-control">
        <span id="helpBlock" class="help-block">Type current password</span>
    </div> -->
    
    <div class="form-group">
        <label for="user_firstName">First Name</label>
        <input type="text" name="user_firstName" value="<?php echo $user_firstName ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastName">Last Name</label>
        <input type="text" name="user_lastName" value="<?php echo $user_lastName ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" required="true" value="<?php echo $user_email ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_title">User Image</label>
        <input type="file" name="user_image" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" >
            <option value="Basic User"><?php echo $user_role; ?></option>

            <?php

                if($user_role == 'Admin') {
                    echo "<option value='Basic User'>Basic User</option>";
                } else {
                    echo "<option value='Admin'>Admin</option>";
                }


            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="user_status">Status</label>
        <select name="user_status" value="<?php echo $user_status ?>">
            <option>Approved</option>
            <option>Unapproved</option>
        </select>
    </div>
    
    <div>
        <input type="submit" name="update_user" value="Update User" class="btn btn-primary">
        <a href="users.php" role="button" class="btn btn-default">Cancel</a>
    </div>

</form>
                

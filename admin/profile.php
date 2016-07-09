<?php include "functions.php"; ?>
<?php include "includes/admin_header.php"; ?>

<?php 

    $current_user_username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$current_user_username}' ";
    $select_user_profile = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_profile)) {
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

<?php updateUserProfile(); ?>

<div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" required="true" value="<?php echo $username; ?>" class="form-control">
                            </div>

                        <!-- <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" name="user_password" required="true" class="form-control">
                                <span id="helpBlock" class="help-block">Type current password</span>
                            </div>  -->
                            
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
                            
                            <div>
                                <input type="submit" name="update_user" value="Update Profile" class="btn btn-primary">
                                <a href="users.php" role="button" class="btn btn-default">Cancel</a>
                            </div>

                        </form> 
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php" ?>
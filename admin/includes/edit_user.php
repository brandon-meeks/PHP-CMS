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

    // Update Post Query
    if(isset($_POST['update_user'])) {

        $username = $_POST['username'];
        // $user_password = $_POST['user_password'];
        $user_firstName = $_POST['user_firstName'];
        $user_lastName = $_POST['user_lastName'];
        $user_email = $_POST['user_email'];

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_role = $_POST['user_role'];
        $user_status = $_POST['user_status'];
        
        
        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        if(empty($user_image)) {
            $query = "SELECT * FROM users WHERE user_id = $select_user_id ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)) {
                $user_image = $row['user_image'];
            }
        }


        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        // $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstName = '{$user_firstName}', ";
        $query .= "user_lastName = '{$user_lastName}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_status = '{$user_status}' ";
        $query .= "WHERE user_id = {$select_user_id} ";

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
        <select name="user_role" value="<?php echo $user_role ?>">
            <option>Basic User</option>
            <option>Admin</option>
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
    </div>

</form>
                

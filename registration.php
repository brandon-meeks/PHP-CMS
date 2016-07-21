<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

 <?php 

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // cleans up the user input
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT randSalt FROM users ";
        $randSaltQuery = mysqli_query($connection, $query);

        if(!$randSaltQuery) {
            die("Query failed " . mysqli_error($connection));
        }

        $row = mysqli_fetch_array($randSaltQuery);
        $salt = $row['randSalt'];
        echo $salt;
        $password = crypt($password, $salt);

        $query = "INSERT INTO users(username, user_email, user_password, user_role, user_status) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'Basic User', 'Unapproved')";
        $registerUserQuery = mysqli_query($connection, $query);

        if(!$registerUserQuery) {
            
            die("User registration failed! " . mysqli_error($connection));

        } else {
            
            $message = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    User was regiered successfully!</div>";
            
        }


    } else {
        $message = "";
    }


 ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <?php echo $message; ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" required="true" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" required="true" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" required="true" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>

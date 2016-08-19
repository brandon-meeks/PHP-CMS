<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 
	// Gets username and password from login form
	if(isset($_POST['login'])) {

        $login_username = $_POST['username'];
        $login_password = $_POST['password'];

        // cleans up the user's input for username and password
        $login_username = mysqli_real_escape_string($connection, $login_username);
        $login_password = mysqli_real_escape_string($connection, $login_password);

        $query = "SELECT * FROM users WHERE username = '{$login_username}' ";
        $select_user_query = mysqli_query($connection, $query);

        if (!$select_user_query) {
            die("Query failed " . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_array($select_user_query)) {

            $user_id = $row['user_id'];
            $username = $row['username'];
            $db_password = $row['user_password'];
            $user_firstName = $row['user_firstName'];
            $user_lastName = $row['user_lastName'];
            $user_role = $row['user_role'];
            $user_status = $row['user_status'];


        }

        // If username and password are not in database, redirect to index
        if (password_verify($login_password, $db_password)) {

            $_SESSION['username'] = $username;
            $_SESSION['user_firstName'] = $user_firstName;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['user_status'] = $user_status;

            header("Location: ../admin");

        } else { // If all else fails user is redirected to index
            header("Location: ../index.php");
        }
    }

?>
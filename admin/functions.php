<?php

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));

}

function insertCategory() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
                                
      $cat_title = escape($_POST['cat_title']);

        if($cat_title == "" || empty($cat_title)) {

            echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                Category Name is required!.</div>";

        } else {

            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query) {

                die('Category creation failed' . mysqli_error($connection));

            }
        } 

    }                           
                            
    
}

function findAllCategories() {
    
    global $connection;
    
    $query = "SELECT *  FROM categories";
                            
        $select_categories_admin = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_categories_admin)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>"; 
        echo "<td><a href='categories.php?edit={$cat_id}' title='edit category'><i class='fa fa-pencil-square-o'></i></a>&nbsp;";
        echo "<a href='categories.php?delete={$cat_id}' title='delete category' class='text-danger'><i class='fa fa-trash'></i></a></td>" ;
        echo "</tr>";               

    }
    
}

function deleteCategory() {
    
    global $connection;
    
    if(isset($_GET['delete'])) {
                                        
        $category_id = escape($_GET['delete']);
        $query = "DELETE FROM categories WHERE cat_id = {$category_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
    
}

function findAllPosts() {
    
    global $connection;
    
    $query = "select * from posts ORDER BY post_id DESC";
    $select_posts_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_admin)) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_view_count = $row['post_view_count'];

        echo "<tr>";
        ?>

        <td><input type="checkbox" class="checkboxes" name="checkboxArray[]" value="<?php echo $post_id; ?>"></td>

        <?php
        echo "<td>{$post_id}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}' target='blank'>{$post_title}</a></td>";
        echo "<td>{$post_author}</td>";

            $cat_query = "SELECT *  FROM categories WHERE cat_id = $post_cat_id ";
                            
            $view_post_cat = mysqli_query($connection, $cat_query);
    
            while($row = mysqli_fetch_assoc($view_post_cat)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";

            }
        if(empty($post_image)) {
            echo "<td></td>";
        } else {
            echo "<td><img src='../images/{$post_image}' alt='{$post_image}' title='{$post_image}' class='img-thumbnail' width='100'/></td>";
        }
        
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments where comment_post_id = $post_id";
        $comment_query = mysqli_query($connection, $query);
        $comment_count = mysqli_num_rows($comment_query);

        if($comment_count == 0) {
            echo "<td>{$comment_count}</td>";
        } else {
            echo "<td><a href='view_post_comments.php?post=$post_id'>{$comment_count}</a></td>";
        }

        echo "<td>{$post_view_count} <a href='posts.php?reset={$post_id}' title='Reset view count'><i class='fa fa-refresh'></i></a></td>";
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' title='edit post'><i class='fa fa-pencil-square-o'></i></a>&nbsp;";
        // echo "<a href='posts.php?delete={$post_id}' title='delete post' class='text-danger'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a></td>";
        echo "<a href='javascript:void(0)' rel='$post_id' title='delete post' class='text-danger delete_link'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a></td>";

        echo "</tr>";

    }
}

function createPost() {
    
    global $connection;
    
        if(isset($_POST['create_post'])) {
        
        $post_title = $_POST['post_title'];
        $post_cat = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
//        $post_date = date('m-d-y');
        
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) SET";
        $query .= "VALUES({$post_cat},'{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
        
        $create_post_query = mysqli_query($connection, $query);
        
        if(!$create_post_query) {

            die('Post creation failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    Post was created successfully!</div>";
            
        }
        
    }
    
}

function editPost() {

}

function deletePost() {
    
    global $connection;
    
    if(isset($_GET['delete'])) {
                                        
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
    
}

function resetPostViews() {
    
    global $connection;
    
    if(isset($_GET['reset'])) {
                                        
        $the_post_id = $_GET['reset'];
        $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$the_post_id} ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");

        if(!$reset_query) {
            die("Reset Failed" . mysqli_error($connection));
        }
    }
    
}

function findAllComments() {
    
    global $connection;
    
    $query = "SELECT *  FROM comments ORDER BY comment_id DESC";
    $select_posts_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_admin)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";

        $post_query = "SELECT *  FROM posts WHERE post_id = $comment_post_id ";
                            
            $view_post_cat = mysqli_query($connection, $post_query);
    
            while($row = mysqli_fetch_assoc($view_post_cat)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";

            }

        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td><a href='comments.php?approve=$comment_id' title='approve comment' class='text-success'><i class='fa fa-thumbs-up'></i></a>&nbsp;|&nbsp;";
        echo "<a href='comments.php?unapprove=$comment_id' title='unapprove comment'><i class='fa fa-thumbs-down'></i></a>&nbsp;|&nbsp;";
        echo "<a href='comments.php?delete=$comment_id' title='delete comment' class='text-danger'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";

    }
}

function findPostComments() {

    if(isset($_GET['post'])) {
        $post_id = $_GET['post'];
    }
    
    global $connection;
    
    $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $post_id);
    $select_posts_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_admin)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";

        $post_query = "SELECT * FROM posts WHERE post_id = " . mysqli_real_escape_string($connection, $comment_post_id);
                            
            $view_post_cat = mysqli_query($connection, $post_query);
    
            while($row = mysqli_fetch_assoc($view_post_cat)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";

            }

        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td><a href='comments.php?approve=$comment_id' title='approve comment' class='text-success'><i class='fa fa-thumbs-up'></i></a>&nbsp;|&nbsp;";
        echo "<a href='comments.php?unapprove=$comment_id' title='unapprove comment'><i class='fa fa-thumbs-down'></i></a>&nbsp;|&nbsp;";
        echo "<a href='comments.php?delete=$comment_id' title='delete comment' class='text-danger'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";

    }
}

function unapproveComment() {
    
    global $connection;
    
    if(isset($_GET['unapprove'])) {
                                        
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
        $unapprove_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
    
}

function approveComment() {
    
    global $connection;
    
    if(isset($_GET['approve'])) {
                                        
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id ";
        $approve_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
    
}

function deleteComment() {
    
    global $connection;
    
    if(isset($_GET['delete'])) {
                                        
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
    
}

function findAllUsers() {
    
    global $connection;
    
    $query = "SELECT *  FROM users";
    $find_users_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($find_users_admin)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstName = $row['user_firstName'];
        $user_lastName = $row['user_lastName'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstName}</td>";
        echo "<td>{$user_lastName}</td>";
        echo "<td>{$user_email}</td>";

        // if(empty($user_image)) {
        //     echo "<td></td>";
        // } else {
        //     echo "<td><img src='../images/users/{$user_image}'/></td>";
        // }
        echo "<td>{$user_role}</td>";
        echo "<td>{$user_status}</td>";
        echo "<td><a href='users.php?approve=$user_id' title='approve user' class='text-success'><i class='fa fa-thumbs-up'></i></a>&nbsp;|&nbsp;";
        echo "<a href='users.php?unapprove=$user_id' title='unapprove user'><i class='fa fa-thumbs-down'></i></a>&nbsp;|&nbsp;";
        echo "<a href='users.php?source=edit_user&user_id={$user_id}' title='edit user'><i class='fa fa-pencil-square-o'></i></a>&nbsp;|&nbsp";
        echo "<a href='users.php?delete=$user_id' title='delete user' class='text-danger'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";

    }
}

function approveUser() {
    
    global $connection;
    
    if(isset($_GET['approve'])) {
                                        
        $the_user_id = $_GET['approve'];
        $query = "UPDATE users SET user_status = 'Approved' WHERE user_id = $the_user_id ";
        $approve_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
    
}

function unapproveUser() {
    
    global $connection;
    
    if(isset($_GET['unapprove'])) {
                                        
        $the_user_id = $_GET['unapprove'];
        $query = "UPDATE users SET user_status = 'Unapproved' WHERE user_id = $the_user_id ";
        $approve_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
    
}

function createUser() {
    
    global $connection;
    
        if(isset($_POST['create_user'])) {
        
            $username = $_POST['username'];
            $user_password = $_POST['user_password'];
            $user_firstName = $_POST['user_firstName'];
            $user_lastName = $_POST['user_lastName'];
            $user_email = $_POST['user_email'];

            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            $user_role = $_POST['user_role'];
            $user_status = $_POST['user_status'];
        
        
        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        $password = password_hash($user_password, PASSWORD_BCRYPT); // Encrpts the user's password
        
        $query = "INSERT INTO users(username, user_password, user_firstName, user_lastName, user_email, user_image, user_role, user_status) SET ";
        $query .= "VALUES('{$username}', '{$password}', '{$user_firstName}', '{$user_lastName}', '{$user_email}', '{$user_image}', '{$user_role}', '{$user_status}') ";
        
        $create_user_query = mysqli_query($connection, $query);
        
        if(!$create_user_query) {

            die('User creation failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>User was created successfully!</div>";
            
        }
        
    }
    
}

function updateUser() {
    global $connection;

    if(isset($_GET['user_id'])) {

        $select_user_id = $_GET['user_id'];
    }

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

        $update_user = mysqli_query($connection, $query);

        if(!$update_user) {

            die('User update failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    User was updated successfully!</div>";
            
        }

    }
}

function updateUserProfile() {
    global $connection;

    $current_user_username = $_SESSION['username'];

    if(isset($_POST['update_user'])) {

        $username = $_POST['username'];
        // $user_password = $_POST['user_password'];
        $user_firstName = $_POST['user_firstName'];
        $user_lastName = $_POST['user_lastName'];
        $user_email = $_POST['user_email'];

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_role = $_POST['user_role'];
        // $user_status = $_POST['user_status'];
        
        
        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        if(empty($user_image)) {
            $query = "SELECT * FROM users WHERE username = '{$current_user_username}' ";
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
        $query .= "user_role = '{$user_role}' ";
        // $query .= "user_status = '{$user_status}' ";
        $query .= "WHERE username = '{$current_user_username}' ";

        $update_profile_query = mysqli_query($connection, $query);

        if(!$update_profile_query) {

            die('Profile update failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    Profile was updated successfully!</div>";
            
            header("Location: profile.php");
        }

    }
}



function deleteUser() {

    if(isset($_SESSION['user_role'])) {

        if($_SESSION['user_role'] == 'admin') {
    
            global $connection;
            
            if(isset($_GET['delete'])) {
                                                
                $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                $delete_query = mysqli_query($connection, $query);
                header("Location: users.php");
            }
        } 
    }
}

function usersOnline() {


    if(isset($_GET['onlineusers'])) {


        global $connection;

        if(!$connection) {

            session_start();

            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, session_time) VALUES('$session', '$time') ");
            } else {
                mysqli_query($connection, "UPDATE users_online SET session_time = '$time' WHERE session = '$session' ");
            }

            $users_online_query = "SELECT * FROM users_online WHERE session_time > '$time_out' ";
            $send_users_query = mysqli_query($connection, $users_online_query);
            echo $count_users = mysqli_num_rows($send_users_query);
        }

    }

}

usersOnline();

// Fucntions for Site Settings

function siteInfo() {

    global $connection;

    if(isset($_POST['save'])) {

        if(isset($_GET['tracking_enabled'])) {
            $trackingEnabled = $_GET['tracking_enabled'];
        }

        $siteName = $_POST['site_name'];
        $siteEmail = $_POST['site_email'];
        $trackingCode = $_POST['tracking_code'];

        $query = "INSERT Into site_settings(site_name, site_admin_email, googleAnalyticsIsEnabled, tracking_code) ";
        $query .= "VALUES('{$siteName}', '{$siteEmail}', $trackingEnabled, '{$trackingCode}')";
        $send_query = mysqli_query($connection, $query);

        if(!$send_query) {
            die("Query Failed" . mysqli_error($connection));
        }
    }

}

function updateSiteInfo() {

    global $connection;

    if(isset($_POST['update'])) {

        if(isset($_POST['tracking_enabled'])) {
            $trackingEnabled = $_POST['tracking_enabled'];
        }

        $siteName = $_POST['site_name'];
        $siteEmail = $_POST['site_email'];
        $trackingCode = $_POST['tracking_code'];

        $query = "UPDATE site_settings SET ";
        $query .= "site_name = '{$siteName}', ";
        $query .= "site_admin_email = '{$siteEmail}', ";
        $query .= "googleAnalyticsIsEnabled = {$trackingEnabled}, ";
        $query .= "tracking_code = '{$trackingCode}' ";


        $send_query = mysqli_query($connection, $query);

        if(!$send_query) {
            die("Query Failed" . mysqli_error($connection));
        }
    }

}

// function getSiteInfo() {
//     global $connection;

//     $query = "SELECT * from site_settings ";
//     $siteInfoQuery = mysqli_query($connection, $query);

//     while($row = mysqli_fetch_assoc($siteInfoQuery)) {
//         $siteName = $row['site_name'];
//         $siteAdminEmail = $row['site_admin_email'];
//         $googleAnalyticsIsEnabled = $row['googleAnalyticsIsEnabled'];
//         $tracking_code = $row['tracking_code'];
//     }
// }

function findAllPages() {
    
    global $connection;
    
    $query = "select * from pages ORDER BY page_id DESC";
    $select_pages_admin = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_pages_admin)) {
        $page_id = $row['page_id'];
        $page_title = $row['page_title'];
        $page_author = $row['page_author'];
        $page_date = $row['page_date'];
        $page_image = $row['page_image'];
        $page_body = $row['page_body'];
        $page_status = $row['page_status'];
        $page_view_count = $row['page_view_count'];

        echo "<tr>";
        ?>

        <td><input type="checkbox" class="checkboxes" name="checkboxArray[]" value="<?php echo $page_id; ?>"></td>

        <?php
        echo "<td>{$page_id}</td>";
        echo "<td><a href='../page.php?url={$page_url}' target='blank'>{$page_title}</a></td>";
        echo "<td>{$page_author}</td>";
        echo "<td>{$page_date}</td>";

        if(empty($page_image)) {
            echo "<td></td>";
        } else {
            echo "<td><img src='../images/{$page_image}' alt='{$page_image}' title='{$page_image}' class='img-thumbnail' width='100'/></td>";
        }
        
        // echo "<td>{$post_tags}</td>";

        echo "<td>{$page_view_count} <a href='pages.php?reset={$page_id}' title='Reset view count'><i class='fa fa-refresh'></i></a></td>";
        
        echo "<td>{$page_status}</td>";
        echo "<td><a href='posts.php?source=edit_page&p_id={$page_id}' title='edit page'><i class='fa fa-pencil-square-o'></i></a>&nbsp;";
        // echo "<a href='posts.php?delete={$post_id}' title='delete post' class='text-danger'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a></td>";
        echo "<a href='javascript:void(0)' rel='$page_id' title='delete page' class='text-danger delete_page_link'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a></td>";

        echo "</tr>";

    }
}

function createPage() {
    
    global $connection;
    
        if(isset($_POST['create_page'])) {
        
        $page_title = $_POST['page_title'];
        $page_author = $_POST['page_author'];
        $page_status = $_POST['page_status'];
        
        $page_image = $_FILES['page_image']['name'];
        $page_image_temp = $_FILES['page_image']['tmp_name'];
        
        $page_body = $_POST['page_body'];
        
//        $post_date = date('m-d-y');
        
        
        move_uploaded_file($page_image_temp, "../images/pages/$page_image");
        
        $query = "INSERT INTO pages(page_title, page_author, page_date, page_image, page_body, page_status, page_url) ";
        $query .= "VALUES('{$page_title}','{$page_author}', now(),'{$page_image}','{$page_body}','{$page_status}', '{page_url}') ";
        
        $create_page_query = mysqli_query($connection, $query);
        
        if(!$create_page_query) {

            die('Page creation failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Page was created successfully!</div>";
            
        }
        
    }
    
}

function resetPageViews() {
    
    global $connection;
    
    if(isset($_GET['reset'])) {
                                        
        $the_page_id = $_GET['reset'];
        $query = "UPDATE pages SET page_view_count = 0 WHERE page_id = {$the_page_id} ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: pages.php");

        if(!$reset_query) {
            die("Reset Failed" . mysqli_error($connection));
        }
    }
    
}


?>
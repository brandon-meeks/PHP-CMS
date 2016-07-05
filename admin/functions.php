<?php

function insertCategory() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
                                
      $cat_title = $_POST['cat_title'];

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
                                        
        $category_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$category_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
    
}

function findAllPosts() {
    
    global $connection;
    
    $query = "SELECT *  FROM posts";
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

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_author}</td>";

            $cat_query = "SELECT *  FROM categories WHERE cat_id = $post_cat_id ";
                            
            $view_post_cat = mysqli_query($connection, $cat_query);
    
            while($row = mysqli_fetch_assoc($view_post_cat)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";

            }


        echo "<td><img src='../images/{$post_image}' alt='{$post_image}' title='{$post_image}' class='img-thumbnail' width='100'/></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' title='edit post'><i class='fa fa-pencil-square-o'></i></a>&nbsp;";
        echo "<a href='posts.php?delete={$post_id}' title='delete post' class='text-danger'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a></td>";
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
        
        $post_date = date('m-d-y');
        // $post_comment_count = 0;
        
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status )";
        $query .= "VALUES({$post_cat},'{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
        
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









?>
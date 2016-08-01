<?php

function createComment() {
    global $connection;

    if(isset($_POST['create_comment'])) {

        $comment_post_id = $_GET['p_id'];
        $comment_date = date('Y-m-d h:i:sa');
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];


        $query = "INSERT INTO comments(comment_post_id, comment_date, comment_author, comment_email, comment_content, comment_status) ";
        $query .= "VALUES ({$comment_post_id}, '{$comment_date}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved') ";

        $create_comment_query = mysqli_query($connection, $query);

        if(!$create_comment_query) {

            die('Comment creation failed ' . mysqli_error($connection));

        } else {
            
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    Comment created successfully and will appear once approved by the admin!</div>";

        }

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $comment_post_id ";
        $update_comment_count_query = mysqli_query($connection, $query);
    }

}



?>
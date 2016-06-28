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
        echo "<td><a href='categories.php?delete={$cat_id}' title='delete category'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a>" . "<a href='categories.php?edit={$cat_id}' title='edit category'><i class='fa fa-pencil-square-o'></i></a></td>";
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








?>
<?php include "../includes/db.php" ?>
<?php include "includes/admin_header.php"; ?>

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
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php 
                            
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
                            
                            
                        ?>
                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Category Name</label>
                                    <input name="cat_title" type="text" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary" /><br /><br />
                                </div>
                            </form>
                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category Name</label>

                                    
                                <?php
                                                                    
                                    if(isset($_GET['edit'])) {
                                        $cat_id = $_GET['edit'];
                                        
                                        $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                                        $select_category_id = mysqli_query($connection, $query);
                                        
                                        while($row = mysqli_fetch_assoc($select_category_id)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            
                                            ?>
                                    
                                    <input value="<?php if(isset($cat_title)) { echo $cat_title; } ?>" name="cat_title" type="text" class="form-control"/>
                                        
                                <?php } ?>
                                    
                                <?php } ?>
                                    
                                <?php // Update Category Query
                                    
                                    if(isset($_POST['update_category'])) {
                                        
                                        $update_cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = $cat_id ";
                                        $edit_query = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                    }                                
                                                                        
                                ?>
                                    
                                    
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_category" value="Update Category" class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                        <!--/ Add Category Form -->
                        <div class="col-xs-6">
                            
                            <?php // Find Categories Query 
                                $query = "SELECT *  FROM categories";
                            
                                $select_categories_admin = mysqli_query($connection, $query);
                            
                            ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                    while($row = mysqli_fetch_assoc($select_categories_admin)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>"; 
                                        echo "<td><a href='categories.php?delete={$cat_id}' title='delete category'><i class='fa fa-trash'>&nbsp;&nbsp;</i></a>" . "<a href='categories.php?edit={$cat_id}' title='edit category'><i class='fa fa-pencil-square-o'></i></a></td>";
                                        echo "</tr>";               

                                } ?>
                                    
                                <?php // Delete Category Query
                                    
                                    if(isset($_GET['delete'])) {
                                        
                                        $category_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = {$category_id} ";
                                        $delete_query = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                    }                                
                                                                        
                                ?>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php" ?>
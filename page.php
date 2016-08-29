<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/functions.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
    <div class="container">

        <div class="row">

        	<div class="col-md-8">

		        <?php 

		    		if(isset($_GET['url'])) {
		    			$view_page_url = $_GET['url'];
		    			$view_query = "UPDATE pages SET page_view_count = page_view_count + 1 WHERE page_url = {$view_page_url} ";
		                $send_query = mysqli_query($connection, $view_query);

		    			$query = "SELECT * FROM pages WHERE page_url = {$page_url}";
		    			$selectPageQuery = mysqli_query($connection, $query);

		    			while($row = mysqli_fetch_assoc($selectPageQuery)) {
		    				$page_title = $row['page_title'];
		    				$page_image = $row['page_image'];
		    				$page_body = $row['page_body'];
		    				$page_status = $row['page_status'];

		    				if($page_status == 'Published') {



		        ?>
				        		<h1 class="page-header"><?php echo $page_title; ?></h1>

				        		<?php 

				                    if(empty($page_image)) {
				                        echo "";
				                    } else {
				                        echo "<img class='img-responsive' src='images/{$page_image}' alt=''>";
				                    }

				                ?>

				                <div id="page_body">
				                	<?php echo $page_body; ?>                	
				                </div> 

                			<?php } ?>

    					<?php } ?>

    				<?php } else {
    					echo "This page cannot be found or has moved. Check your url: $page_url";
    					}
    				?>       	

       		</div>

    	</div>


		<!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>


<?php include "includes/footer.php"; ?>
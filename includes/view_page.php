<?php 

	if(isset($_GET['page_url'])) {
		$page_url = $_GET['page_url']

		$query = "SELECT * FROM pages WHERE page_url = {$page_url}";
		$pageQuery = mysqli_query($connection, $pageQuery);

		if(!$pageQuery) {
			die("Query Failed " . mysqli_error($connection))
		}
	}

?>
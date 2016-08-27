<?php 

	$query = "SELECT * FROM site_settings";
	$trackingQuery = mysqli_query($connection, $query);

	While($row = mysqli_fetch_assoc($trackingQuery)) {
		$trackingCode = $row['tracking_code'];
	}


?>

<!-- Google Analytics Tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $trackingCode; ?>', 'auto');
  ga('send', 'pageview');

</script>
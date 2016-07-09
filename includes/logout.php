<?php session_start(); ?>

<?php 

	$_SESSION['username'] = null;
	$_SESSION['user_firstName'] = null;
	$_SESSION['user_role'] = null;
	$_SESSION['user_status'] = null;

	header("Location: ../index.php")
?>
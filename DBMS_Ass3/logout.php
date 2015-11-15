<?php
	session_start();
	session_destroy();
	$page = 'home.php';
	header('Location: '.$page);
?>
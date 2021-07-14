<?php 
	$conn = new mysqli('localhost', 'root', '','banhangdienmay');
	mysqli_set_charset($conn, 'utf8');
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>
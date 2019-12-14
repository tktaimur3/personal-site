<?php 
	session_start();
	mysql_connect('localhost', 'root', 'supercool245');
	mysql_select_db('lr');
	$id = $_SESSION['id'];

	$strSQL = "DELETE FROM members WHERE user_id = $id";
	mysql_query($strSQL);

	header("Location: index.php");
 ?>
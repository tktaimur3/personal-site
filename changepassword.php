<?php 
	include 'index(1).php';
	ob_start();

	if ($_SESSION['loggedIn'] === true || $_SESSION['loggedIn'] !== null) {
		mysql_connect('localhost', 'root', 'supercool245');
		mysql_select_db('lr');
	}
	else if ($_SESSION['loggedIn'] === false || $_SESSION['loggedIn'] === null)
?>

<form action="changepassword.php" method="post">
	<input type="password" name="currentPass">
	<input type="password" name="newPass">
	<input type="submit" name="changePass">
</form>

<?php include 'index (2).php'; ?>
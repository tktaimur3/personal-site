<?php include 'index(1).php'; ?>

<nav>
	<ul>
		<a href="contact.php">
			<li>Contact</li>
		</a>
		
		<a href="pictures.php">
			<li>Pictures</li>
		</a>

		<a href="projects.php">
			<li>Projects</li>
		</a>

		<a href="about.php">
			<li>About</li>
		</a>
			
		<a link="black" href="index.php">
			<li>Home</li>
		</a>
	</ul>
</nav>

<article>
	<h1>Change Password</h1>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<?php 
	ob_start();
	
	if ($_SESSION['loggedIn'] === true || $_SESSION['loggedIn'] !== null) {
		if (isset($_POST['changePass'])) {
			$username = $_SESSION['username'];
			$SQL = "SELECT * FROM members WHERE username='$username'";
			$rs = $link->query($SQL);
			$row = $rs->fetch_array(MYSQLI_ASSOC);

			$currentPassDatabase = $row['password'];
			$currentPassDatabase = $link->escape_string($currentPassDatabase);
			$currentPassUsertype = @$_POST['currentPass'];
			$currentPassUsertype = $link->escape_string($currentPassUsertype);
			$newPass = @$_POST['newPass'];
			$newPass = $link->escape_string($newPass);

			if (!empty($currentPassUsertype) && !empty($newPass)) {
				if (password_verify($currentPassUsertype, $currentPassDatabase)) {
					$SQL = "UPDATE members SET password=? WHERE username=?";
					$stmt = $link->prepare($SQL);
					$stmt->bind_param('ss', crypt($newPass), $username) or die("Failed, try again later");
					$stmt->execute();
					$stmt->close();

					header("Location: login.php");
				}
				else {
					echo "<p style=\"color: red\">Wrong password, make sure type in your current password</p>";
				}
			}
			else {
				echo "<p style=\"color: red\">Please fill in all fields</p>";
			}
		}
	}
	else if ($_SESSION['loggedIn'] === false || $_SESSION['loggedIn'] === null) {
		header("Location: login.php");
	}
?>


		<br>Current Password:<br><input type="password" name="currentPass"><br><br>
		New Password:<br><input type="password" name="newPass"><br><br>
		<input type="submit" name="changePass">
	</form>
</article>

<?php if ($_SESSION['loggedIn'] === true || $_SESSION['loggedIn'] !== null) { 
	include 'index (2).php';
} 

	ob_end_flush();
	?>
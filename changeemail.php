<?php 
	include 'index(1).php';
?>

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
	<h1>Change Email</h1>

	<form action="changeemail.php" method="post">
		<p>New Email:</p>

		<?php
		ob_start();

		$username = $_SESSION['username'];
		$email = @$_POST['newEmail'];
		$link->escape_string($email);

		if ($_SESSION['loggedIn'] === true || $_SESSION['loggedIn'] !== null || $_SESSION['username'] !== null) {
			if (isset($_POST['change'])) {
				$checkSql = "SELECT * FROM members WHERE email=?";
				$stmt = $link->prepare($checkSql);
				$stmt->bind_param('s', $email);
				$stmt->execute();
			    $stmt->store_result();
	    		$count = @$stmt->num_rows();

				if ($count != 1) {
					$SQL = "UPDATE members SET email=? WHERE username=?";
					$stmt = $link->prepare($SQL);
					$stmt->bind_param('ss', $email, $username);
					$stmt->execute();
					$stmt->close();
					header("Location: login.php");
					$_SESSION['email'] = $email;
				}
				else {
					echo "<p style=\"color: red\">Email already taken!</p>";
				}	
			}	
		}
		else if ($_SESSION['loggedIn'] === false || $_SESSION['loggedIn'] === null) {
			header("Location: login.php");
		}
		?>
		<input type="email" name="newEmail"><br><br>
		<input type="submit" name="change" value="Change Email">
	</form>
</article>

<?php include 'index (2).php'; ?>
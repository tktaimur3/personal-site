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
<h1>Register</h1>
	<form action="register.php" method="post">
	<?php ob_start();

	$first_name = @$_POST['firstname'];
	$last_name = @$_POST['lastname'];
	$email = @$_POST['email'];
	$username = @$_POST['username'];
	$password = @$_POST['password'];

	$_SESSION['loggedIn'] = false;

	if (@$_SESSION['loggedIn'] !== true) {
		if (isset($_POST['register'])) {
			$link->escape_string($first_name) or die('Mysql escape_string error');
			$link->escape_string($last_name) or die('Mysql escape_string error');
			$link->escape_string($email) or die('Mysql escape_string error');
			$link->escape_string($username) or die('Mysql escape_string error');
			$link->escape_string($password) or die('Mysql escape_string error');

			$userSql = "SELECT * FROM members WHERE username=?";
			$emailSql = "SELECT * FROM members WHERE email=?";
			$stmt1 = $link->prepare($userSql);
			$stmt1->bind_param('s', $username);
			$stmt1->execute();
			$stmt1->close();

			$stmt2 = $link->prepare($emailSql);
			$stmt2->bind_param('s', $email);
			$stmt2->execute();
			$stmt2->close();

			$count = $stmt1->num_rows();
			$count2 = $stmt2->num_rows();

			if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($username) && !empty($password)) {
				if ($count == 1 && $count2 == 1) {
					echo "<p style=\"color: red\">Username and email taken, try another. You may already have an account</p>";
				}
				else if ($count == 1) {
					echo "<p style=\"color: red\">Username taken, try another. You may already have an account</p>";
				}
				else if ($count2 == 1) {
					echo "<p style=\"color: red\">Email taken, try another. You may already have an account</p>";
				}
				else if ($count != 1 && $count2 != 1) {
					$strSQL = "INSERT INTO members(first_name, last_name, username, password, email) VALUES(?, ?, ?, ?, ?)";
					$stmt = $link->prepare($strSQL);
					$stmt->bind_param('sssss', $first_name, $last_name, $username, crypt($password, $passwords), $email);
					$stmt->execute() or die('Failed to create account, try again later');
					$stmt->close();
					header("Location: login.php");
				}
			}
			else {
				echo "<p style=\"color: red\">Fill in all fields</p>";
			}
		}
		else if (isset($_POST['login'])) {
			header("Location: login.php");
		}
	}
	else {
		header("Location: login.php");
	}
?>
		<input type="text" name="firstname" placeholder="First Name" autofocus><br>
		<input type="text" name="lastname" placeholder="Last Name"><br>
		<input type="email" name="email" placeholder="Email"><br>
		<input type="text" name="username" placeholder="Username"><br>
		<input type="password" name="password" placeholder="Password"><br><br>
		<input type="submit" name="register" value="Register">
		<input type="submit" name="login" value="Login"><br><br><br>
		
	</form>
</article>

<?php 
ob_end_flush();
include 'index (2).php'; 
?>
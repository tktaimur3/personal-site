<?php include 'index(1).php' ?>

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
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h1>Forgot Password</h1>
		<p>We'll send you an email with your new password, then you can change it!</p>
		<?php
			ob_start();
			$email = @$_POST['email'];
			$link->escape_string($email);

			if (isset($_POST['sendPass'])) {
				if (!empty($email)) {
					$SQL = "SELECT * FROM members";
					$stmt = $link->prepare($SQL);
					$stmt->execute();
					$count = $stmt->num_rows();

					if ($count == 1) {
						$rs = $link->query($SQL);
						$row = $rs->fetch_array(MYSQLI_ASSOC);
						$randPass = md5(sha1($row['password']));

						$MySQL = "UPDATE members SET password=? WHERE email=?";
						$stmt2 = $link->prepare($MySQL);
						$stmt2->bind_param('ss', crypt($randPass), $email);
						$stmt2->execute();
						$stmt2->close();
						mail($email, "Password for taimurinc.org", "Here's your new password: ".$randPass);
						echo $randPass;
						//header("Location: login.php");
					}
					else {
						echo "<p style=\"color: red\">No user found in the database which has that email!</p>";
					}
				}
				else {
					echo "<p style=\"color: red\">Fill in the email field!</p>";
				}
			}
		?>
		<input type="email" name="email" placeholder="Email">
		<input type="submit" name="sendPass" value="Change Pass"><br><br>
	</form>
</article>

<?php include 'index (2).php'; 
ob_end_flush();
?>
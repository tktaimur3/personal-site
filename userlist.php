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
	<h1>User List</h1>
	<p>All the users currently registered</p>

	<?php 
		$SQL = "SELECT first_name, username FROM members";
		$stmt = $link->prepare($SQL);
		$stmt->execute();

		if (@$_SESSION['loggedIn'] === true && $_SESSION['first_name'] !== null) {
			$stmt->bind_result($first_n, $username);
			while ($stmt->fetch()) {
				echo "<li><strong>First Name:</strong> ".$first_n." <strong>Username:</strong> ".$username."</li><br>";
			}
		}
		else if (@$_SESSION['loggedIn'] !== true) {
			echo "<p><a href=\"login.php\">Login</a> to view the user list!</p>";
		}
	?>
</article>

<?php include 'index (2).php' ?>
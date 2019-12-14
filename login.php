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

<?php if (@$_SESSION['loggedIn'] !== true || $_SESSION['loggedIn'] === null) { ?>
<article>
	<h1>Login</h1>
	<form action="login.php" method="post">
<?php
	ob_start();

	$myusername = @$_POST['username'];
	$mypassword = @$_POST['password'];

	if (isset($_POST['logged'])) {
	    $link->escape_string($myusername);
	    $link->escape_string($mypassword);
   	 	$stmt = $link->prepare("SELECT * FROM members WHERE username=?") or die ($link->error);
	    $stmt->bind_param('s', $myusername);
	    $stmt->execute() or die($stmt->error);
	    $stmt->store_result();
	    $count = $stmt->num_rows();

	    if (!empty($myusername) && !empty($mypassword)) {
	        if($count == 1) {
	        	$rs = $link->query("SELECT * FROM members WHERE username='$myusername'");
	            $row = $rs->fetch_array(MYSQLI_ASSOC);
	            if (crypt($mypassword, $row['password']) == $row['password']) {
		            $_SESSION['username'] = $myusername;
		            $_SESSION['first_name'] = $row['first_name'];
		            $_SESSION['last_name'] = $row['last_name'];
		            $_SESSION['email'] = $row['email'];
		            $_SESSION['admin'] = $row['admin'];
		            $_SESSION['loggedIn'] = true;
		            header("Location: login.php");
	        	}
	        	else {
	        		echo "<p style=\"color: red\">Wrong Password</p>";
	        	}
	        }
	        else {
	            echo "<p style=\"color: red\">Wrong Username</p>";
	        }
	    }
	    else {
	        echo "<p style=\"color: red\">Fill in all fields</p>";
	    }
	}
?>
		<input type="text" name="username" placeholder="Username" autofocus><br>
		<input type="password" name="password" placeholder="Password"><br><br>
		<input type="submit" name="logged" value="Login">
		<!--<p>Forgot password? <a href="forgotpass.php">Click here</a></p>-->
	</form>
</article>
<?php 
} 
else if ($_SESSION['loggedIn']) {

?>
<article>
	<h1>Welcome, <?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></h1>

	<p>Your email is <?php echo $_SESSION['email']; ?> <a href="changeemail.php">Click here to change email</a></p>
	<p><a href="changepass.php">Click here to change password</a></p>

	<form action="logout.php">
		<input type="submit" value="Logout">
	</form>
</article>
<?php 
}

include 'index (2).php';
ob_end_flush();
?>
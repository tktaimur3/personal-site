<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<link rel="icon" type="image/png" href="favicon.png" />
		<script src="jquery.min.js"></script>
		<script type="text/javascript" src="app.js"></script>
		<title>Taimur's Site</title>
	</head>
<style>
        @media screen 
	and (min-device-width : 768px) 
	and (max-device-width : 1024px) 
	and (orientation : landscape) {
         article {
                 margin-top: 6%;
         }
        }
</style>
	<body>
		<div class="content">
			<header>
				<figure>
					<img src="pictures/GameLogo.png" style="width: 7%; padding-bottom: 2%;">
					<figcaption>
						
					</figcaption>
				</figure>
				<div class="status">
					<?php 
					session_start();
					$link = new mysqli("localhost", "root", "", "lr");

					/* check connection */
					if (mysqli_connect_errno()) {
					    printf("Connect failed: %s\n", mysqli_connect_error());
					    exit();
					}

					 if (@$_SESSION['loggedIn'] !== true) { ?>
						<p><a href="login.php">Login</a> or <a href="register.php">Register</a></p>
					<?php
					}
					else if (@$_SESSION['loggedIn'] === true && $_SESSION['first_name'] !== null) 
					{
						$fname = $_SESSION['first_name'];
						$lname = $_SESSION['last_name'];
						$username = $_SESSION['username'];
						$email = $_SESSION['email']; 
						$admin = @$_SESSION['admin'];
						?>
						<?php
						if (@$_SESSION['admin'] === true) {
						?>
						<p>Logged in as <?php echo $fname." ".$lname ?>, Welcome Admin!</p>
						<?php	
						} else {
						?>
						<p>Logged in as <?php echo $fname." ".$lname ?></p>
						<?php
						}
						?>
						<?php if ( $admin == 1 /*$username === "epicman2456" && $fname === "Taimur" && $lname === "Khan" && $email === "taimur2245@gmail.com"*/) { 
							$_SESSION['admin'] = true; 
						}
						?>
						<p><a href="userlist.php">User List</a></p>
						<p style="line-height: 0.3em"><a href="login.php">Account</a></p>
					<?php
					}
					?>
				</div>
			</header>
<?php include 'index(1).php'; ?>



        <nav>
	<ul>
		<a href="contact.php">
			<li class="selected">Contact</li>
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
	<h1>Contact</h1>				
	<p style="text-align: center">Feel free to contact me via Twitter or Google+ anytime.</p>
		<hr>
				
	<ul class="contact">
		<li>
			<a href="https://plus.google.com/102345838324694006821/posts">
				<img src="pictures/Google+Logo.jpg">
			</a>
		</li>
					
		<li>
			<a href="https://twitter.com/TECHMAN74635">
				<img src="pictures/TwitterLogo.jpg">
			</a>
		</li>
	</ul>
	<?php if (@$_SESSION['loggedIn'] === true) {?>
	<hr>
	<p style="text-align: center">You can also E-Mail me by typing in the fields below:</p>
	<form action="post.php" method="post">
		<center>
			<p style="margin-top: 3%; margin-bottom: -0.1%;"><strong style="color: red">*</strong> Message:</p>
			<textarea class="input" name="message" rows="4" autocomplete='off' cols="30" required formnovalidate></textarea>
		</center>
				
		<center>
			<input id="button" type="submit" value="Submit Feedback!" style="margin-top: 10px"></input>
		</center>
	</form>
	<?php 
	} 
	else {
	?>
	<p style="text-align: center">Hey! Please <a href="login.php">Login</a> to send me feedback via E-mail!</p>
	<?php 
	}
	?>
</article>

<?php include 'index (2).php'; ?>
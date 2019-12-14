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
			<li class="selected">About</li>
		</a>
			
		<a link="black" href="index.php">
			<li>Home</li>
		</a>
	</ul>
</nav>
<article>
	<h1><strong>About</strong></h1>

	<p>This website is basically a test site (Or maybe even full site) that I will be using to update about myself, and learn more CSS and HTML.</p>

	<p>I learned most of my coding skills from Codecademy. Though
	I did learn better website making skills from Codeschool. Before I learned HTML and CSS, I used to program in Java and C#,
	it was fun to program in those languages but I just felt I really didn't like these languages. Then I decided to learn
	HTML, and boy was it a good idea because I learned a LOT from it and I became more used to creating websites.</p>

	<p>At first, when learning with Codecademy, I wasn't really good at making websites. I didn't know how to properly design websites, make them look good, 
	what kind of features I should add but after I started learning with Codeschool it became easier. But I still thank Codecademy for starting me off.</p>

	<hr>

	<h3>Blog Posts!</h3>

	<?php if (@$_SESSION['admin'] === 1 || @$_SESSION['email'] === "taimur2245@gmail.com") {
	$author = $_SESSION['first_name'];
	?>
		<form action="about.php" method="post">
			<p style="margin-bottom: -0.3%">Title:</p><input class="input" type="text" name="title" autocomplete='off' placeholder="Title" ><br>
			<p style="margin-bottom: -0.3%">Text:</p><textarea class="input" name="text" cols="30" rows="3" autocomplete='off' placeholder="Post Content"></textarea><br><br>
			<input id="submit" type="submit" name="submit" value="Add post">
		</form>
		<br>
		<hr>
		<br>
	<?php 
		}

		$title = @$_POST['title'];
		$text = @$_POST['text'];

		if (isset($_POST['submit'])) {
			$link->escape_string($title);
			$link->escape_string($text);
			$y = date('Y');
			$m = date('m');
			$d = date('d');
			$dt = $y.'-'.$m.'-'.$d;

			$sql = "INSERT INTO `lr`.`blog_post` (`author`, `title`, `text`, `time_posted`) VALUES (?, ?, ?, ?)";
			$stmt = $link->prepare($sql);
			$stmt->bind_param('ssss', $author, $title, $text, $dt);
			$stmt->execute();

/*
			$sql2 = "SELECT * FROM blog_post";
			$rs = $link->query($sql2);
			$rw = $rs->fetch_array(MYSQLI_ASSOC);
*/

			$id = "posts/".($_SESSION['id'] + 1).".php";
			$handle = fopen($id, 'w') or die('Hu');
			$contents = "<?php include 'posts.php'; ?>
							<article class=\"post\">
								<h1><?php echo '$title'; ?></h1> 
								<p style=\"font-size: 0.7em\">'$dt'</p>
								<hr>
								<p><?php echo '$text'; ?></p>
							</article>

							<?php include '../index (2).php'; ?>";
			fwrite($handle, $contents);
                        fclose($handle);
			echo "Awwww yeah";
			header("Location: about.php");
		}

		$SQL = "SELECT title, text, blog_id FROM blog_post ORDER BY blog_id DESC";
		$stmt = $link->prepare($SQL);
		$stmt->execute();

		$stmt->bind_result($title, $text, $blog_id);
		while ($stmt->fetch()) {
			$_SESSION['title'] = $title;
			//$_SESSION['text'] = $text;
			$_SESSION['id'] = $blog_id - 1;
			echo "<li style=\"font-size: 1.2em; line-height: 1.5em\"><strong>Title:</strong> ".$_SESSION['title']." <a href="."posts/".$_SESSION['id'].".php>See post</a></li>";
		}
	?>
</article>

<?php include 'index (2).php'; ?>
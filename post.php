<?php
	session_start();
	$from = $_SESSION['username']; // sender
	$message = $_POST["message"];
	// message lines should not exceed 70 characters (PHP rule), so wrap 
	$message = wordwrap($message, 70);
	// send mail
	$sent = mail("taimur2245@gmail.com", "WEBSITE FEEDBACK", $message, $from);
	if ($sent) {
		echo "<div style=\"font-family: Sans-Serif; text-align: center\">
					<p>Thank you for sending us feedback <a href=\"index.php\">Click here to go back</a></p>
			  </div>";
    }
	else {
		echo "Error occurred, try again later";
	}
?>
<?php 
include( 'parse-contact.php' );
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Us</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
</head>
<body>
	<div class="contact-form">
		<h1>Contact Us</h1>

		<?php include('form-feedback.php'); ?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
			<label>Your Name</label>
			<input type="text" name="name">

			<label>Email Address</label>
			<input type="email" name="email">

			<label>Phone Number</label>
			<input type="tel" name="phone">

			<label>How can we help you?</label>
			<select name="reason">
				<option>Choose one:</option>
				<option value="support">I need customer support.</option>
				<option value="bug report">I'm reporting a bug.</option>
				<option value="hi">I just wanted to say Hi!</option>
			</select>

			<label>Message</label>
			<textarea name="message"></textarea>

			<input type="submit" value="Send Message">
			<input type="hidden" name="did_submit" value="1">
		</form>
	</div>

	<div class="debug">
		<h2>testing the body of the message</h2>
		<pre><?php echo $body; ?></pre>

		<h2>Cleaned up data:</h2>

		<p>Name: <?php echo $name; ?></p>
		<p>Email: <?php echo $email; ?></p>
		<p>Phone: <?php echo $phone; ?></p>
		<p>Reason: <?php echo $reason; ?></p>
		<p>Message: <?php echo $message; ?></p>
	

		<h2>Uncleaned POST data:</h2>
		<pre><?php print_r($_POST); ?></pre>		
	</div>



</body>
</html>
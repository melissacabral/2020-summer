<?php require('config.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php require('includes/login-parse.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in to your account</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container important-form">
		<h1>Log In</h1>

		<?php 
	//if there is feedback, show it
		if( isset( $feedback ) ){
			echo "<b>$feedback</b>";
		}
		?>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>Username</label>
			<input type="text" name="username">

			<label>Password</label>
			<input type="password" name="password">

			<input type="submit" value="Log In">

			<input type="hidden" name="did_submit" value="1">
		</form>

	</div><!-- end container -->

<?php include( 'includes/debug-output.php' ); ?>
</body>
</html>
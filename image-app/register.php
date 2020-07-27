<?php require('config.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php require('includes/register-parse.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign up for an account</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container important-form">
		<h1>Create your account</h1>
		<p>Sign up to upload posts, comment and like other posts.</p>

		<?php if( isset( $feedback ) ){ ?>
		<div class="feedback <?php echo $feedback_class; ?>">
			<h2><?php echo $feedback; ?></h2>

			<?php if( ! empty($errors) ){ ?>
			<ul>
				<?php foreach( $errors AS $item ){ ?>
				<li><?php echo $item; ?></li>
				<?php } ?>
			</ul>
			<?php } //end if not empty ?>

		</div>
		<?php } //end if feedback isset ?>



		<form method="post" action="register.php">
			<label>Username</label>
			<input type="text" name="username">

			<label>Password</label>
			<input type="password" name="password">

			<label>Email Address</label>
			<input type="email" name="email">

			<label>
				<input type="checkbox" name="policy" value="1">
				I agree to the <a href="#" target="_blank">terms of service</a>
			</label>

			<input type="submit" value="Sign Up">
			<input type="hidden" name="did_register" value="1">
		</form>
	</div>


<?php include('includes/debug-output.php'); ?>
</body>
</html>
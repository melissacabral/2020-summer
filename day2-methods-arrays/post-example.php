<?php 
//turn off notices (remove this to debug)
error_reporting( E_ALL & ~E_NOTICE );

//process the form if the user submitted it
$television = $_REQUEST['tv'];
$fave_movie = $_REQUEST['movie'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Post method example</title>
	<style type="text/css">
		input{
			display:block;
			margin-bottom:1em;
		}
	</style>
</head>
<body>

	<h1>POST Method</h1>

	<form method="post" action="post-example.php">
	
		<label>What is your favorite TV Show?</label>
		<input type="text" name="tv" value="<?php echo $television; ?>">

		<label>What is your favorite movie?</label>
		<input type="text" name="movie" value="<?php echo $fave_movie; ?>">

		<input type="submit" value="Go!">
	</form>


	<div class="feedback">
		<h2>Your answers:</h2>

		Your favorite TV show is: <?php echo $television; ?>

		<br>

		Your favorite Movie is: <?php echo $fave_movie; ?>
	</div>

</body>
</html>
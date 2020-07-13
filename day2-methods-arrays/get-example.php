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
	<title>Get method example</title>
	<style type="text/css">
		input{
			display:block;
			margin-bottom:1em;
		}
	</style>
</head>
<body>

	<h1>GET Method</h1>

	<form method="get" action="get-example.php">
	
		<label>What is your favorite TV Show?</label>
		<input type="text" name="tv">

		<label>What is your favorite movie?</label>
		<input type="text" name="movie">

		<input type="submit" value="Go!">
	</form>


	<div class="feedback">
		<h2>Your answers:</h2>

		Your favorite TV show is: <?php echo $television; ?>

		<br>

		Your favorite Movie is: <?php echo $fave_movie; ?>
	</div>


	<div>
		<h2>Contents of the SuperGlobal Array</h2>

		<pre>
		<?php print_r( $_SERVER ); ?>
		</pre>
	</div>

</body>
</html>
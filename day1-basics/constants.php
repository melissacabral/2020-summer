<?php 
//how to define a constant. constants can only contain simple values (string, number, boolean) and can't be changed after being defined
define('MYNAME', 'Melissa');

//this line will fail because it is already defined and can't be defined again
define('MYNAME', 'Bob');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Constant Example</title>
</head>
<body>
	<h1>Constant Example</h1>

	<h2>What's my name?</h2>
	<p>
		<?php echo MYNAME; ?>
	</p>

</body>
</html>
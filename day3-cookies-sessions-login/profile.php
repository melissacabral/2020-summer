<?php 
error_reporting( E_ALL & ~E_NOTICE );

//begin or resume the session
session_start();

//if the cookie is still valid, recreate the session
if( $_COOKIE['loggedin'] == 1 ){
	//set the session var
	$_SESSION['logged_in'] = 1;
}

//if the login session is not valid, kill the page
if( $_SESSION['logged_in'] != 1 ){
	die('You must be logged in to see this page');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Your Profile</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
</head>
<body>
	<a href="login.php?intent=logout" class="button button-outline">Log Out</a>

	<h1>Your Profile</h1>
	This is a secret page! 
	<img src="http://placecorgi.com/300/250">


	<h2>COOKIE data:</h2>
	<pre>
		<?php print_r($_COOKIE); ?>
	</pre>


	<h2>SESSION data:</h2>
	<pre>
		<?php print_r($_SESSION); ?>
	</pre>
</body>
</html>
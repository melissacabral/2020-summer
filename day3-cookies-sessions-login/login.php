<?php
//begin or resume the session
session_start();

//define the correct username and password (TODO: replace with DB later)
$correct_username = 'Melissa';
$correct_password = 'phprules';

//logout logic. 
//URL will have ?intent=logout at the end if trying to logout
if( $_GET['intent'] == 'logout' ){
	//invalidate all cookies - set them to expire in the past
	setcookie( 'loggedin', 0, time() - 9999 );
	
	//end the session and invalidate all session vars
	
	// Unset all of the session variables.
	// source: https://www.php.net/manual/en/function.session-destroy
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_destroy();
}//end logout


//parse the login form if the user submitted it
if( isset( $_POST['did_submit'] ) ){
	//compare what the user submitted to the correct credentials
	if( $_POST['username'] == $correct_username AND $_POST['password'] == $correct_password ){
		//success - store cookies and sessions, and then redirect to the profile page
		//remember this user for 1 week
		$expire =  time() + ( 60 * 60 * 24 * 7 );
		setcookie( 'loggedin', 1, $expire );
		
		//create a session var with the same purpose
		$_SESSION['logged_in'] = 1;

		header('Location:profile.php');
	}else{
		//error - show a message on this page
		$feedback = 'Incorrect username/password combination. Try again.';
	}
} //end of form parser
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log In to your account</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
</head>
<body>
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


	<h2>POST data:</h2>
	<pre>
		<?php print_r($_POST); ?>
	</pre>

</body>
</html>
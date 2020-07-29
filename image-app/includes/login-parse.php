<?php
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
	//clean everything
	$username = clean_string( $_POST['username'] );
	$password = clean_string( $_POST['password'] );
	
	//validate
	$valid = true;
		//username wrong length (must be 4 - 30 chars)
	if( strlen( $username ) < 4 OR strlen( $username ) > 30 ){
		$valid = false;
	}	
		//password too short (min 8)
	if( strlen( $password ) < 8 ){
		$valid = false;
	}	
	
	//if valid, check for a match in the DB
	//get the salt associated with this username
	$sql = "SELECT salt, password, user_id FROM users
			WHERE username = '$username'
			LIMIT 1";

	$result = $db->query($sql);
	if( ! $result ){
		echo $db->error;
	}
	//if one row found, move on to checking the password
	if( $result->num_rows >= 1 ){
		//user salt found
		while( $row = $result->fetch_assoc() ){
			$salt = $row['salt'];
			$correct_password = $row['password'];
			//add the salt to the PW, hash it and then compare to the password in the result
			$password = sha1( $password . $salt );
			//if they match, SUCCESS!
			if( $password == $correct_password ){
				$feedback ='Success';
				//set cookies and session vars
				$expire = time() + (60 * 60 * 24 * 14);
				$user_id = $row['user_id'];
				setcookie( 'user_id', $user_id, $expire );
				$_SESSION['user_id'] = $user_id;

				//store the salt (obscured) as a cookie
				$obscured_salt = sha1($salt);
				setcookie( 'salt', $obscured_salt, $expire );
				$_SESSION['salt'] = $obscured_salt;

				//redirect to home page
				header( 'Location:index.php' );
			}else{
				$feedback = 'Incorrect username/password combo. (password wrong)';
			}

		}//end while
	}else{
		//no user with that name
		$feedback = 'Incorrect username/password combo. (username wrong)';
	} //end if username found
	
} //end of form parser
<?php
//parse the form if they hit submit
if( isset($_POST['did_register']) ){
	//clean every field
	$username 	= clean_string( $_POST['username'] );
	$email 		= clean_email( $_POST['email'] );
	$password 	= clean_string( $_POST['password'] );
	$policy 	= clean_boolean( $_POST['policy'] );

	//validate
	$valid = true;
		//username wrong length (must be 4 - 30 chars)
	if( strlen( $username ) < 4 OR strlen( $username ) > 30 ){
		$valid = false;
		$errors[] = 'Username must be between 4 - 30 characters long.';
	}else{
		//username already taken
		$sql = "SELECT username FROM users
				WHERE username = '$username'
				LIMIT 1";
		//run it
		$result = $db->query($sql);
		//check it (if we found a row, this name is taken!)
		if( $result->num_rows >= 1 ){
			$valid = false;
			$errors[] = 'That username is already taken. Try another.';
		}
	} //end username tests
		
		
		//email blank or wrong format
	if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors[] = 'Please provide a valid email.';
	}else{
		//email already taken
		$sql = "SELECT email FROM users
				WHERE email = '$email'
				LIMIT 1";
		//run it
		$result = $db->query($sql);
		//check it
		if( $result->num_rows >= 1 ){
			$valid = false;
			$errors[] = 'That email address is already taken. Do you want to log in?';
		}
	} //end email tests
		
		
		//password too short (min 8)
	if( strlen( $password ) < 8 ){
		$valid = false;
		$errors[] = 'Choose a password that is at least 8 characters long.';
	}
		
		//didn't check policy box
	if( $policy != 1 ){
		$valid = false;
		$errors[] = 'You must agree to the terms of service before signing up.';
	}

	//if valid, add the new user to the DB & setup feedback 
	if( $valid ){
		//create user
		// add the salt 
		$salt = bin2hex(random_bytes( 10 ));
		
		$salted_pw = $password . $salt;
		// sha1 secure hash algorithm one way
		$hashed_password = sha1($salted_pw);
		// hash the password
		$sql = "INSERT INTO users
				( username, email, password, is_admin, join_date, salt )
				VALUES 
				( '$username', '$email', '$hashed_password', 0, now(), '$salt' )";
		//run it
		$result = $db->query($sql);
		//check it twice
		if( ! $result ){
			echo $db->error;
		}
		if( $db->affected_rows >= 1 ){
			//success
			$feedback = 'Success! You may now log in to your account.';
			$feedback_class = 'success';
		}else{
			//error
			$feedback = 'Error creating your account. Try again later.';
			$feedback_class = 'error';
		}
	}else{
		$feedback = 'There were problems with your registration. Fix the following:';
		$feedback_class = 'error';
	}//end if valid
	
}//end if did_register
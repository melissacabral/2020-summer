<?php 
error_reporting( E_ALL & ~E_NOTICE );

//parse the form if it was submitted
if( $_POST['did_submit'] ){
	//sanitize every field
	$name 		= filter_var( $_POST['name'], 		FILTER_SANITIZE_STRING );
	$email 		= filter_var( $_POST['email'],		FILTER_SANITIZE_EMAIL );
	$phone 		= filter_var( $_POST['phone'], 		FILTER_SANITIZE_NUMBER_INT );
	$reason 	= filter_var( $_POST['reason'], 	FILTER_SANITIZE_STRING );
	$message 	= filter_var( $_POST['message'], 	FILTER_SANITIZE_STRING);

	//validate - run checks on the required data
	$valid = true;

	//name is blank or longer than 50 chars
	if( $name == '' OR strlen( $name ) > 50 ){
		$valid = false;
		$errors[] = 'Please fill in your name. It cannot be longer than 50 characters.';
	}

	//email is wrong format
	if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors[] = 'Please provide a valid email address.';
	}

	//reason given is not on the list of valid reasons
	$valid_reasons = array( 'support', 'bug report', 'hi' );
	if( ! in_array( $reason, $valid_reasons ) ){
		$valid = false;
		$errors[] = 'Please choose one of the provided reasons.';
	}

	//message is blank or too long
	if( $message == '' OR strlen($message) > 1000  ){
		$valid = false;
		$errors[] = 'Please fill in the message. It cannot be longer than 1000 characters';
	}

	//if valid, send mail, show feedback, etc
	if( $valid ){
		//send the mail
		$to = 'mcabral@platt.edu';
		$subject = "$name is reaching out to say: $reason";

		$body = "Phone: $phone\n";
		$body .= "Email: $email\n";
		$body .= "Reason: $reason\n\n";
		$body .= "$message";

		$headers = "From: contact@melissacabral.com\r\n";
		$headers .= "Reply-to: $email";

		$mail_sent = mail( $to, $subject, $body, $headers );

		//show feedback
		if( $mail_sent ){
			$feedback = 'Thank you. Your message was sent successfully.';
		}else{
			$feedback = 'I\'m sorry, your message could not be sent at this time. Try again.';
		}

	}else{
		//error feedback
		$feedback = 'Your message could not be sent. Please fix the following:';
	}

} //end form parser

?>
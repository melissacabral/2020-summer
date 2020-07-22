<?php
//parse the comment if they submitted one
if( isset( $_POST['did_comment'] ) ){
	//sanitize everything
	$body = mysqli_real_escape_string( $db, filter_var( $_POST['body'], FILTER_SANITIZE_STRING ) );
	//TODO: this is a temporary fake logged in user. remove this when we build the login
	$user_id = 1;

	//validate - body cannot be blank
	$valid = true;

	if( $body == '' ){
		$valid = false;
		$feedback = 'Error. Please fill in the comment field.';
	}
	
	//if valid, add it to the database
	if( $valid ){
		$sql = "INSERT INTO comments
				( body, user_id, date, post_id, is_approved )
				VALUES 
				( '$body', $user_id, now(), $post_id, 1 )";
		$result = $db->query( $sql );
		//check it
		if( !$result ){
			echo $db->error;
		}
		if( $db->affected_rows >= 1 ){
			//it worked
			$feedback = 'Thank you for commenting';
		}else{
			//it didn't work
			$feedback  = 'Your comment could not be added at this time.';
		} //end if affected rows
	
	}//if valid
		
}//end if comment submitted
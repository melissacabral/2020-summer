<?php
//parse the form if they submitted it
if( isset( $_POST['did_edit'] ) ){
	//clean everything
	$title 			= clean_string( $_POST['title'] );
	$body 			= clean_string( $_POST['body'] );
	$category_id 	= clean_int( $_POST['category_id'] );
	$allow_comments = clean_boolean( $_POST['allow_comments'] );
	
	//validate!
	$valid = true;
		//title can't be blank or longer than 50 chars
	if( $title == '' OR strlen( $title ) > 50 ){
		$valid = false;
		$errors[] = 'Write a title that is up to 50 characters long.';
	}
		//body can't be longer than 2200
	if( strlen( $body ) > 2200 ){
		$valid = false;
		$errors[] = 'The body can\'t be longer than 2,200 characters';
	}	
		//category ID isn't a number
	if( ! is_numeric( $category_id ) ){
		$valid = false;
		$errors[] = 'Please choose a category from the list.';
	}	
	
	// if valid, UPDATE the post, and show feedback
	if( $valid ){
		$sql = "UPDATE posts
				SET 
					title = '$title',
					body = '$body',
					category_id = $category_id,
					allow_comments = $allow_comments,
					is_published = 1
				WHERE post_id = $post_id
				AND user_id = $user_id";
		$result = $db->query( $sql );
		if(! $result){
			echo $db->error;
		}
		if( $db->affected_rows >= 1 ){
			$feedback = 'Post successfully saved';
			$feedback_class = 'success';
		}else{
			$feedback = 'No changes were made to the post';
			$feedback_class = 'neutral';
		}//end if affected rows
	}else{
		$feedback = 'Your post could not be saved. Fix the following:';
		$feedback_class = 'error';

	}//end if valid
	
}//end did_edit
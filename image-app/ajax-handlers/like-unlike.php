<?php 
/**
 * AJAX Handler File for LIKE/UN-LIKE
 * this file sits behind-the-scenes on the server.
 * it handles the like/unlike database logic and passes back the updated like_interface HTML
 * @TODO: Remove the feedback on failure (line 49)
 */

//get needed dependencies
require('../config.php');
include_once('../includes/functions.php');

//incoming data from JS AJAX call
$post_id = $_REQUEST['postId'];
$user_id = $_REQUEST['userId'];

//check to see if the user likes this post or not
$query = "SELECT * FROM likes
			WHERE user_id = $user_id
			AND post_id = $post_id
			LIMIT 1";
$result = $db->query( $query );

if( !$result ){
	echo $db->error;

}elseif( $result->num_rows >= 1 ){
	// they like it, REMOVE the row
	$query = "DELETE FROM likes
				WHERE user_id = $user_id
				AND post_id = $post_id";
}else{
	//they don't yet like it, ADD the row
	$query = "INSERT INTO likes
				( post_id, user_id )
				VALUES 
				( $post_id, $user_id )";
}


//run the resulting query
$result = $db->query( $query );
//if it worked, update the interface

if( $db->affected_rows >= 1 ){
	like_interface( $post_id, $user_id );
}else{
	//TODO: remove after testing
	echo 'like failed';
}
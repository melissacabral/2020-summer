<?php 
if( $logged_in_user ){
?>
<section class="comment-form" id="reply">
	<h2>Leave a comment</h2>

	<?php 
	if( isset( $feedback ) ){
		echo $feedback;
	} 
	?>

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>#reply" method="post">
		<label>Comment:</label>
		<textarea name="body"></textarea>

		<input type="submit" value="Post Comment">
		<input type="hidden" name="did_comment" value="1">
	</form>
	
</section>

<?php } //end if logged in
else{
	echo 'Please log in to comment.';
} ?>
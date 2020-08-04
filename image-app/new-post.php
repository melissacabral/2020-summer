<?php require('config.php'); ?>
<?php require('includes/header.php'); 

//if this page is accessed by a non-logged-in user, kill the page
if( ! $logged_in_user ){
	die('You must be logged in to see this page');
}

require( 'includes/upload-parse.php' );
?>

<main class="content">	
	<div class="important-form">
		<h1>New Post</h1>

		<?php 
		if( isset($feedback) ){
			echo $feedback;
		} 
		?>

		<form enctype="multipart/form-data" method="post" action="new-post.php">
			<label>Image: (jpg, gif or png only)</label>
			<input type="file" name="uploadedfile" accept="image/*">

			<input type="submit" value="Next: post details &rarr;">
			<input type="hidden" name="did_upload" value="1">
		</form>
	</div>
</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
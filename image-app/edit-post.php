<?php require('config.php'); ?>
<?php require('includes/header.php'); 

//if this page is accessed by a non-logged-in user, kill the page
if( ! $logged_in_user ){
	die('You must be logged in to see this page');
}

//get the post_id out of the query string
//url will look like edit-post.php?post_id=X
$post_id = clean_int( $_GET['post_id'] );
$user_id = $logged_in_user['user_id'];

require('includes/edit-post-parse.php');
?>

<main class="content">	
	<div class="important-form">
		<h1>Edit Post</h1>

		<?php display_post_image( $post_id ); ?>

		<?php if( isset( $feedback ) ){ ?>
		<div class="feedback <?php echo $feedback_class; ?>">
			<h2><?php echo $feedback; ?></h2>

			<?php if( ! empty($errors) ){ ?>
			<ul>
				<?php foreach( $errors AS $item ){ ?>
				<li><?php echo $item; ?></li>
				<?php } ?>
			</ul>
			<?php } //end if not empty ?>

		</div>
		<?php } //end if feedback isset ?>
		

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<label>Title</label>
			<input type="text" name="title">

			<label>Caption</label>
			<textarea name="body"></textarea>

			<?php //get all the categories in alphabetical order by name
			$sql = "SELECT * FROM categories
					ORDER BY name ASC";
			$result = $db->query( $sql );
			if( !$result ){
				echo $db->error;
			}
			if( $result->num_rows >= 1 ){
			?>
			<label>Category</label>
			<select name="category_id">
				<option>Choose a category</option>
				<?php while( $row = $result->fetch_assoc() ){ ?>
				<option value="<?php echo $row['category_id']; ?>">
					<?php echo $row['name']; ?>
				</option>
				<?php } //end while ?>
			</select>
			<?php } //end if categories ?>


			<label>
				<input type="checkbox" name="allow_comments" value="1">
				Allow comments on this post
			</label>

			<input type="submit" value="Save Post">
			<input type="hidden" name="did_edit" value="1">
		</form>		
	</div>
</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
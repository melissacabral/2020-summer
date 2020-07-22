<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>

<?php 
//Template for showing one single post and its comments
// URL will look like /single.php?post_id=X

//what post are we trying to show?
$post_id = $_GET['post_id'];
?>
<?php include( 'includes/comment-parse.php' ); ?>

<main class="content">	

	<?php //get the post we're trying to show
	$sql = "SELECT posts.post_id, posts.image, posts.title, posts.body, posts.date, users.username, users.profile_pic, 
					categories.*
			FROM posts, users, categories
			WHERE posts.is_published = 1
				AND posts.user_id = users.user_id
				AND posts.category_id = categories.category_id
				AND post_id = $post_id
			ORDER BY posts.date DESC 
			LIMIT 10";
	//run it
	$result = $db->query($sql);
	//check it (twice)
	//check for big errors
	if( ! $result ){
		echo $db->error;
	}
	//are there rows (posts) found
	if( $result->num_rows >= 1 ){
		//loop it. 
		while( $row = $result->fetch_assoc() ){
	?>
	<div class="post">
		
		<img src="<?php echo $row['image']; ?>">				
		
		<span class="author">
			<img src="<?php echo $row['profile_pic']; ?>" width="50" height="50">
			<span class="username"><?php echo $row['username']; ?></span>
		</span>
		<h2><?php echo $row['title']; ?></h2>
		<p><?php echo $row['body']; ?></p>
		<span class="category"><?php echo $row['name']; ?></span>
		<span class="date"><?php time_ago( $row['date'] ); ?></span>
	</div>
	<?php 
		} //end while

		//free it (releases any resources or memory consumed by the query)
		$result->free();
	}else{
		echo 'No New Posts';
	}//end if posts
	?>

	<?php 
	//Comments section
	//get all the approved comments on this post, oldest first
	$sql = "SELECT users.profile_pic, users.username, comments.body, comments.date
			FROM users, comments
			WHERE users.user_id = comments.user_id
				AND comments.is_approved = 1
				AND comments.post_id = $post_id
			ORDER BY comments.date ASC
			LIMIT 20";
	//run it
	$result = $db->query($sql);
	//check it for errors
	if( ! $result ){
		echo $db->error;
	}	
	//check for rows (comments) in the result
	if( $result->num_rows >= 1 ){
	?>
	<section class="comments">
		<h2>Comments on this post:</h2>

		<?php while( $row = $result->fetch_assoc() ){ ?>
		<div class="one-comment">
			<div class="user">
				<img src="<?php echo $row['profile_pic']; ?>" width="30" height="30">
				<?php echo $row['username']; ?>
			</div>

			<p><?php echo $row['body']; ?></p>

			<span class="date"><?php nice_date( $row['date'] ); ?></span>
		</div>
		<?php } //end while
		//free it
		$result->free();
		?>

	</section>
	<?php } //end if ?>

	<?php include( 'includes/comment-form.php' ); ?>
</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
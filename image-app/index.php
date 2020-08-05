<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>

<main class="content">	

	<?php //get the most recent 10 published posts, newest first
	$sql = "SELECT posts.post_id, posts.image, posts.title, posts.body, posts.date, users.username, users.profile_pic, 
					categories.*
			FROM posts, users, categories
			WHERE posts.is_published = 1
				AND posts.user_id = users.user_id
				AND posts.category_id = categories.category_id
			ORDER BY posts.date DESC 
			LIMIT 8";
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
		<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
			<?php display_post_image(  $row['post_id'], 'large' ); ?>				
		</a>
		<span class="author">
			<img src="<?php echo $row['profile_pic']; ?>" width="50" height="50">
			<span class="username"><?php echo $row['username']; ?></span>
		</span>
		<h2><?php echo $row['title']; ?></h2>
		<p><?php echo $row['body']; ?></p>
		<span class="comment-count"><?php count_comments( $row['post_id'] ); ?></span>
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

</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
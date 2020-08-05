<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>

<main class="content">	

	<?php 
	//what category are we trying to show?
	//URL will look like category.php?cat_id=x
	$category_id = clean_int($_GET['cat_id']);

	//make sure it's not invalid (not a number)
	if( ! is_numeric($category_id) ){
		$category_id = 0;
	}

	//PAGE TITLE: look up the name of this category
	$sql = "SELECT name FROM categories 
	WHERE category_id = $category_id
	LIMIT 1";
	$result  = $db->query($sql);
	if($result->num_rows >= 1){
		$row = $result->fetch_assoc();
		echo '<h2>Posted in: '. $row['name'] . '</h2>';
		$result->free();
	}else{
		die('Invalid Category');
	}
	?>
	<div class="grid">

		<?php
		//get the most recent 10 published posts, newest first
		$sql = "SELECT posts.post_id, posts.image, posts.title, posts.body, posts.date, users.username, users.profile_pic, 
		categories.*
		FROM posts, users, categories
		WHERE posts.is_published = 1
		AND posts.user_id = users.user_id
		AND posts.category_id = categories.category_id
		AND posts.category_id = $category_id
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
				<div class="item">
					<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
						<?php display_post_image(  $row['post_id'], 'medium' ); ?>				
					</a>
					<span class="author">
						<img src="<?php echo $row['profile_pic']; ?>" width="50" height="50">
						<span class="username"><?php echo $row['username']; ?></span>
					</span>
					<h2><?php echo $row['title']; ?></h2>
					<span class="comment-count"><?php count_comments( $row['post_id'] ); ?></span>
					<span class="date"><?php time_ago( $row['date'] ); ?></span>
				</div>
				<?php 
		} //end while

		//free it (releases any resources or memory consumed by the query)
		$result->free();
		?>

	</div><!-- end .grid -->
	<?php	
	}else{
		echo 'No Posts in this category';
	}//end if posts
	?>


</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
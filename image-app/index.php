<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>

<main class="content">	

	<?php //get the most recent 10 published posts, newest first
	$sql = "SELECT post_id, image, title, body, date
			FROM posts
			WHERE is_published = 1
			ORDER BY date DESC 
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
		<a href="SINGLE_URL">
			<img src="<?php echo $row['image']; ?>">				
		</a>
		<span class="author">
			<img src="PROFILE_PIC" width="50" height="50">
			<span class="username">USERNAME</span>
		</span>
		<h2><?php echo $row['title']; ?></h2>
		<p><?php echo $row['body']; ?></p>
		<span class="category">CATEGORY_NAME</span>
		<span class="date"><?php echo $row['date']; ?></span>
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
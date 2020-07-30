<aside class="sidebar">	
	
	<?php //get the 5 most recently registered users 
	$sql = "SELECT username, profile_pic, user_id
			FROM users
			ORDER BY join_date DESC
			LIMIT 5";
	//run it
	$result = $db->query($sql);
	//check it (twice)
	if( ! $result ){
		echo $db->error;
	}
	//check to see if we got more than 1 row
	if( $result->num_rows >= 1 ){
	?>
	<section class="users">
		<h2>Newest Users:</h2>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li class="user">
				<a href="profile.php?user_id=<?php echo $row['user_id']; ?>">
					<img src="<?php echo $row['profile_pic']; ?>" width="50" height="50">
					<?php echo $row['username']; ?>
				</a>
			</li>
			<?php } //end while
			//free the results
			$result->free();
			?>
		</ul>
	</section>
	<?php } //end if ?>


	<?php //get all the categories in alphabetical order
	$sql = "SELECT categories.name, COUNT(*) AS total
			FROM posts, categories
			WHERE posts.category_id = categories.category_id
			GROUP BY posts.category_id";
	$result = $db->query($sql);
	//check for error
	if( !$result ){
		echo $db->error;
	}
	//check for	at least 1 row found
	if( $result->num_rows >= 1 ){
	?>	
	<section class="categories">
		<h2>Image categories:</h2>
		<ul>			
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li>
				<?php echo $row['name']; ?> (<?php echo $row['total']; ?>)	
			</li>
			<?php } //end while
			$result->free(); ?>			
		</ul>
	</section>
	<?php } //end if row found ?>




<?php //get the 5 most recent approved comments, newest first
	//bonus: make it a join and get the comment author's name ?>
	<section class="comments">
		<h2>Recent Comments:</h2>
		<ul>			
			<li>
				<span class="username">USERNAME</span> said:
				<span class="commentbody">BODY</span>
			</li>
		</ul>
	</section>
</aside>
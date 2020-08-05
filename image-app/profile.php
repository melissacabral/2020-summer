<?php require('config.php'); ?>
<?php require('includes/header.php');?>

<main class="content">	

<?php 
//which user's profile are we trying to show?
//url will look like profle.php?user_id=X
if( isset( $_GET['user_id'] ) ){
	$user_id = $_GET['user_id'];
}elseif( $logged_in_user ){
	//if no query string variable, use the logged in person
	$user_id = $logged_in_user['user_id'];
}else{
	$user_id = 0;	
}

//get their info from the DB
$sql = "SELECT profile_pic, username, bio 
		FROM users
		WHERE user_id = $user_id
		LIMIT 1";

$result = $db->query($sql);
if( ! $result ){
	echo $db->error;
}
if( $result->num_rows >= 1 ){
	while( $row = $result->fetch_assoc() ){
		//new technique (will create $profile_pic, $username, $bio)
		extract($row);		
	}
?>

	<section class="user user-profile">
		<img src="<?php echo $profile_pic; ?>" class="profile-pic">
		<h2><?php echo $username; ?></h2>
		<p><?php echo $bio; ?></p>
	</section>

	<?php //get 20 most recent of the user's posts 
	$sql = "SELECT * FROM posts 
		WHERE user_id = $user_id 
		AND is_published = 1 
		LIMIT 20";
	$result = $db->query($sql);
	if( !$result ){
		echo $db->error;
	}
	if( $result->num_rows >= 1 ){
	?>
	<div class="grid">
		<?php while( $row = $result->fetch_assoc() ){ ?>
		<div class="item">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
				<?php display_post_image($row['post_id']); ?>
			</a>
			<h3><?php echo $row['title']; ?></h3>
		</div>
		<?php } //end while ?>
	</div>
	<?php 
	}else{
		echo 'This user hasn\'t posted anything yet.';
	}//end if posts found ?>

<?php 
}else{
	echo 'Invalid User';
} //end if user found 
?>

</main>
<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
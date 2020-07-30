<?php require('config.php'); ?>
<?php require('includes/header.php'); 

//which user's profile are we trying to show?
//url will look like profle.php?user_id=X
if( isset( $_GET['user_id'] ) ){
	$user_id = $_GET['user_id'];
}else{
	//if no query string variable, use the logged in person
	$user_id = $logged_in_user['user_id'];
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
}
?>
<main class="content">	
	<section class="user user-profile">
		<img src="<?php echo $profile_pic; ?>" class="profile-pic">
		<h2><?php echo $username; ?></h2>
		<p><?php echo $bio; ?></p>
	</section>


	<div class="grid">
		TODO: get this user's posts from the DB
	</div>

</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
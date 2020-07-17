<?php require( 'config.php' ); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Image App: Home</title>
</head>
<body>
	<h1>Welcome to Image App Home Page</h1>

	<?php 
	//get all the posts
	$sql = "SELECT title, image 
			  FROM posts"; 
	
	//run it and catch the response (result)
	$result = $db->query($sql);
	
	//check to see if posts were found
	if( $result->num_rows > 0 ){
	?>
	<ul>
		<?php //loop it
		while( $row = $result->fetch_assoc() ){
		?>
		<li>
			<h2><?php echo $row['title']; ?></h2>
			<img src="<?php echo $row['image']; ?>">
		</li>
		<?php } //end while loop ?>		
	</ul>
	<?php } //end if posts found ?>
</body>
</html>
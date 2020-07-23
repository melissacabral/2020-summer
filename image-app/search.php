<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>
<?php 
//search query parser
// sanitize the phrase 
$phrase = clean_string( $_GET['phrase'] );
//get all the posts that contain the phrase (title or body)
echo $sql = "SELECT post_id, image, title, date
		FROM posts
		WHERE ( title LIKE '%$phrase%' OR body LIKE '%$phrase%' )
		AND is_published = 1
		ORDER BY date DESC";
$result = $db->query($sql);
//check for errors
if( ! $result ){
	echo $db->error;
}	
$total = $result->num_rows;
?>
<main class="content">	

	<?php if( $total >= 1 ){ ?>
	<section class="title">
		<h2>Search Results</h2>
		<p><?php echo $total; ?> posts found. Showing page CURRENT of MAXPAGES.</p>
	</section>

	<div class="grid">
		<?php while( $row = $result->fetch_assoc() ){ ?>
		<div class="item">
			<a href="single.php?post_id=X">
				<img src="<?php echo $row['image']; ?>" width="150" height="150">
			</a>
			<h3><?php echo $row['title']; ?></h3>
			<span class="date"><?php nice_date( $row['date'] ); ?></span>
		</div>
		<?php } ?>

	</div> <!-- end .grid -->
	<?php }else{ ?>

	<div class="noposts">
		<h2>No posts found matching <?php echo $phrase; ?></h2>
	</div>

	<?php } //end if total at least 1 ?>
</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
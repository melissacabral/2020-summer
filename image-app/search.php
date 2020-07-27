<?php require('config.php'); ?>
<?php require('includes/header.php'); ?>
<?php 
//search configuration - number of posts per page
$per_page = 12;

//search query parser
// sanitize the phrase 
$phrase = clean_string( $_GET['phrase'] );
//get all the posts that contain the phrase (title or body)
$sql = "SELECT post_id, image, title, date
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
//how many pages will it take to hold the posts found? round up with the ceiling function!
$max_page = ceil( $total / $per_page );

//what page are we on? 
//search.php?phrase=bla&page=2
$current_page = $_GET['page'];
//check if that is not a valid page
if( ! is_numeric( $current_page ) OR $current_page < 1 OR $current_page > $max_page ){
	$current_page = 1;
}
//add a LIMIT to the original query
$offset = ( $current_page - 1 ) * $per_page ;
$sql .= " LIMIT $offset, $per_page";
//run it
$result = $db->query( $sql );
//check it
if( !$result ){
	echo $db->error;
}
?>
<main class="content">	

	<?php if( $total >= 1 ){ ?>
	<section class="title">
		<h2>Search Results</h2>
		<p>
			<?php echo $total; ?> posts found. Showing page <?php echo $current_page; ?> of <?php echo $max_page; ?>.
		</p>
	</section>

	<div class="grid">
		<?php while( $row = $result->fetch_assoc() ){ ?>
		<div class="item">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
				<img src="<?php echo $row['image']; ?>" width="150" height="150">
			</a>
			<h3><?php echo $row['title']; ?></h3>
			<span class="date"><?php nice_date( $row['date'] ); ?></span>
		</div>
		<?php }//end while
		$result->free();
		?>

	</div> <!-- end .grid -->
	<?php 
	$prev_page = $current_page - 1;
	$next_page = $current_page + 1;	
	?>
	<div class="pagination">
		<?php if( $current_page != 1 ){ ?>
		<a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $prev_page; ?>" class="button">
			&larr; Previous Page
		</a>
		<?php } //end if ?>

		<?php
		//optional "numbered" pagination 
		for( $num = 1; $num <= $max_page; $num++ ){ ?>
		<a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $num; ?>" class="button button-outline">
			<?php echo $num; ?>
		</a>
		<?php } //end for ?>



		<?php if( $current_page != $max_page ){ ?>
		<a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $next_page; ?>" class="button">
			Next Page &rarr;
		</a>
		<?php } //end if ?>

	</div>


	<?php }else{ ?>

	<div class="noposts">
		<h2>No posts found matching <?php echo $phrase; ?></h2>
	</div>

	<?php } //end if total at least 1 ?>
</main>

<?php require('includes/sidebar.php'); ?>		
<?php require('includes/footer.php'); ?>		
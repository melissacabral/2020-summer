<?php 
//only show the feedback if it exists
if( isset( $feedback ) ){
?>
<div class="feedback">
	<h2><?php echo $feedback; ?></h2>

	<?php 
	//if errors list exists, show it
	if( ! empty( $errors ) ){			
		echo '<ul>';
		foreach( $errors as $error ){
			echo "<li>$error</li>";
		}
		echo '</ul>';			
	} //end if errors not empty
	?>

</div>
<?php 
} //end if feedback exists 
?>
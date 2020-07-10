<?php 
/*
	Define all your functions at the beginning of the document for later use. 
	These functions get called later (in the body of the document)
*/

//example of how to define a simple function. 
function do_stuff(){
	echo 'The function doesn\'t do much, but it did echo this line';
	echo '<br>';
	echo 'It also echoed this line. ';
	echo 'We will learn more than just echo, I promise.';
}

//example with arguments added
function display_message( $heading, $body ){
	echo '<div class="message">';
	echo "<h1>$heading</h1>";
	echo "<p>$body</p>";
	echo '</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Function Example</title>
	<style type="text/css">
		body{
			font-family: Calibri, sans-serif;
		}
		.message{
			background-color:lightgreen;
			padding:.5em;
		}
	</style>
</head>
<body>
	<h1>Function Example</h1>
	<p>A function is a re-usable piece of code that runs when you call it. </p>

	<h2>How to call a simple function</h2>
	<p>
		<?php do_stuff(); ?>
	</p>
	
	<h2>Function with arguments - Example</h2>

	<?php display_message('Success', 'Congrats, it worked'); ?>

</body>
</html>
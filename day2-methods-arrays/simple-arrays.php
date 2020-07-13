<?php 
error_reporting( E_ALL & ~E_NOTICE );

//create a list of pizza toppings
$pizza_toppings = array( 'mushrooms', 'caramelized onions', 'artichokes', 'basil'  );

//add 1 more topping
$pizza_toppings[] = 'Banana peppers';

//count the number of items in the array
$count = count( $pizza_toppings );

//randomize the toppings
shuffle( $pizza_toppings );

?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Arrays</title>
</head>
<body>
	<h1>Your Pizza Order:</h1>

	<p>Your pizza has <?php echo $count; ?> toppings</p>

	<p>The first item in the list is: <?php echo $pizza_toppings[0]; ?></p>

	<div>
		<pre><?php print_r($pizza_toppings); ?></pre>
	</div>


	<h2>Better looking list with a foreach loop</h2>

	<ul>
		<?php 
		//loop!
		foreach( $pizza_toppings as $topping ){
			echo "<li>$topping</li>";
		}
		?>		
	</ul>

</body>
</html>
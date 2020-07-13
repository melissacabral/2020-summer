<?php 
//Create an associative array
// 'key' => 'value'
$pizza_ingredients = array(
	'crust' => 'Crispy Thin Crust',
	'sauce'	=> 'Classic Red',
	'cheese' => '3 Cheese blend',
	'toppings' => 'olives and mushrooms',
);

//add one more item
$pizza_ingredients['glaze'] = 'balsamic reduction';

//alphabetize the list
//by value
//asort($pizza_ingredients);

//by key
ksort($pizza_ingredients);

//count the items
$count = count( $pizza_ingredients );

?>
<!DOCTYPE html>
<html>
<head>
	<title>Associative Array Examples</title>
</head>
<body>
	<h1>Your Pizza Order</h1>

	<p>Number of ingredients: <?php echo $count; ?></p>

	<p>
		<pre><?php print_r( $pizza_ingredients ); ?></pre>
	</p>

	<ul>
		<?php 
		foreach($pizza_ingredients as $key => $value ){
			echo "<li><b>$key</b>: $value</li>";
		}; 

		
		?>
	</ul>


</body>
</html>
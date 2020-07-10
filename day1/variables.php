<?php 
//how to define variables. you can use them any line below where they are defined

//string values go in single quotes
$breakfast = '2 cups of coffee';

//number values don't need quotes
$number_of_students = 9;

//bonus: variable with dynamic value (day of the week using the date() function)
$day_of_week = date('l');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Variable Example</title>
</head>
<body>
	<h1>Variable Examples</h1>

	<h2>What did you have for breakfast?</h2>
	<p>
		<?php echo $breakfast; ?>
	</p>

	<h2>How many students are in this class?</h2>
	<p>
		<?php echo $number_of_students; ?>
	</p>

	<h2>What day is it?</h2>
	<p>
		<?php echo $day_of_week; ?>
	</p>

</body>
</html>
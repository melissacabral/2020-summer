<?php 
$feedback = 'This is the value of the feedback variable'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Example logic</title>
</head>
<body>

    <?php if( isset($feedback) ){ ?>
    <div>
    	<h2>This div should only happen if feedback exists</h2>
    	<p><?php echo $feedback; ?></p>
 	</div>
    <?php } //end if ?>

    <p>Just some other random stuff in the body Lorem ipsum dolor sit amet, onsectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

</body>
</html>
<?php require_once( 'includes/functions.php' ); 

$logged_in_user = check_login();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Image App</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
</head>
<body>
	<div class="site">
		<header class="header">
			<h1><a href="index.php">Image App</a></h1>

			<nav class="main-navigation">
				<form class="searchform" method="get" action="search.php">
					<label class="screen-reader-text">Search:</label>
					<input type="search" name="phrase">
					<input type="hidden" name="page" value="1">
					
					<input type="submit" value="Search">
				</form>

				<ul class="menu">
					<?php if( $logged_in_user ){ ?>
					<li><a href="new-post.php">New Post</a></li>
					<li>
						<a href="profile.php">
						<?php echo $logged_in_user['username']; ?>'s account
						</a>
					</li>
					<li><a href="login.php?intent=logout">Log Out</a></li>
					
					<?php }else{ ?>
					<li><a href="login.php">Log In</a></li>
					<li><a href="register.php">Sign Up</a></li>
					
					<?php } ?>

				</ul>
			</nav>
		</header>
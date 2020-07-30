<?php if( DEBUG_MODE ){ ?>
<div class="debug-output">
	<?php if( isset($logged_in_user) ){ ?>
	<h2>Logged in User info</h2>
	<pre><?php print_r( $logged_in_user ); ?></pre>
	<?php } ?>

	<h2>POST data:</h2>
	<pre><?php print_r( $_POST ); ?></pre>

	<h2>GET data:</h2>
	<pre><?php print_r( $_GET ); ?></pre>

	<h2>COOKIE data:</h2>
	<pre><?php print_r( $_COOKIE ); ?></pre>	

	<h2>SESSION data:</h2>
	<pre><?php print_r( $_SESSION ); ?></pre>

	<h2>FILES data:</h2>
	<pre><?php print_r( $_FILES ); ?></pre>

	<h2>SERVER data</h2>
	<pre><?php print_r( $_SERVER ); ?></pre>
</div>
<?php } ?>
		<footer class="footer">
			&copy; 2020 Image App
		</footer>
		
	</div> <!-- end div.site -->

	<?php include('includes/debug-output.php'); ?>



	<script type="text/javascript">

		console.log('hello world');

		//when the user clicks a heart button, do stuff
		$('.likes').on( 'click', '.heart-button', function(){
			//which post and which user?
			var postId = $(this).data('postid');
			var userId = <?php echo $logged_in_user['user_id']; ?>;

			//test!
			console.log( postId, userId );

		} );
	</script>
</body>
</html>
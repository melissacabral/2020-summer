		<footer class="footer">
			&copy; 2020 Image App
		</footer>
		
	</div> <!-- end div.site -->

	<?php include('includes/debug-output.php'); ?>



	<script type="text/javascript">

		//when the user clicks a heart button, do stuff
		$('.likes').on( 'click', '.heart-button', function(){
			//which post and which user?
			var postId = $(this).data('postid');
			var userId = <?php echo $logged_in_user['user_id']; ?>;

			//test!
			console.log( postId, userId );
			
			//keep track of which HTML heart was clicked
			var likes_container = $(this).parents('.likes');

			//do the ajax call!
			$.ajax({
				method: 'GET',
				url: 'ajax-handlers/like-unlike.php',
				data: { 'userId' : userId, 'postId': postId },
				success: function( response ){
					//update the interface
					likes_container.html(response);
				},
				error: function(){
					console.log('ajax error');
				}
			});			

		}); //end of click event 
	</script>
</body>
</html>
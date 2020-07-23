<?php 

	require_once 'assets/php/admin-header.php';

 ?>
	
	<!-- Footer Area Start -->
	<div class="row justify-content-center my-2">
		<div class="col-lg-6" id="showNotification">
			
		</div>
	</div>
	<!-- Footer Area End -->


			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

			// Fetch Notification Ajax Request

			fetchNotification();

			function fetchNotification(){
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { action: 'fetchNotification' },
					success:function(response){
						$("#showNotification").html(response);
					}
				});
			}

			// Check Notification on Admin Panel side bar
			checkNotification();

			function checkNotification(){
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { action: 'checkNotification' },
					success:function(response){
						$("#checkNotification").html(response);
					}
				});
			}

			// Remove Notification From Admin panel Ajax Request
			$("body").on("click", ".close", function(e){
				e.preventDefault();

				notification_id = $(this).attr('id');

				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { notification_id: notification_id },
					success:function(response){
						fetchNotification();
						checkNotification();
					}
				});
			});

		});
	</script>
</body>
</html>
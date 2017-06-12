	<script src="{{ URL::asset('assets/js/jquery-1.12.4.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/sweetalert.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/slidebar.js') }}"></script>
	<script src="{{ URL::asset('assets/js/script.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		    $(".clickable-row").click(function() {
		        window.location = $(this).data("href");
		    });
		});
	</script>
	<!-- <script type="text/javascript">
		function deleteMutu(){
			swal({
			  title: "",
			  text: "You will not be able to recover this imaginary file!",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, delete it!",
			  closeOnConfirm: false
			},
			function(){
			  window.location.replace("http://www.google.com");
			});
		}
	</script> -->
</body>
</html>
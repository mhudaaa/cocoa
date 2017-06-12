<!DOCTYPE html>
<html>
<head>
	<title>Cacao</title>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/animate.min.css') }}">
	<style type="text/css">
		input{
			color: #000;
		}
	</style>
	
	<script type="text/javascript">
  		window.onscroll = function () {
		 // window.scrollTo(0,0);
		}
	</script>
</head>
<body id="login" class="bg-brown">
	<div id="wrapper">
		<div class="login-header"></div>
		<div class="row text-center">
			<div class="col-xs-8 col-xs-offset-2">
				<form class="login-form" method="post" action="/login">
					<p>{{ Session::get('message') }}</p>
					{{ csrf_field() }}
					<input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit" class="btn bg-brown-2 text-uppercase spacing-1 btn-rounded btn-block">Login</button>
				</form>
				<!-- <a href="/admin/dashboard">
					<button class="btn bg-brown-2 text-uppercase spacing-1 btn-rounded btn-block">Login</button>
				</a> -->
			</div>
		</div>
	</div>
</body>
</html>
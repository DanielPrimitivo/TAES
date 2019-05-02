<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> FireViewer @yield('title')</title>
	<!--TODO: Add layout css -->
	<link rel="icon" type="image/png" href="{{ URL::asset('/fireviewer/logo.png') }}">
  <!-- Icon css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- CSS Bootstrap -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <!-- jquery for bootsrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- JS Bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<!-- Main CSS -->
		<link rel="stylesheet" href="{{ URL::asset('/css/main.css') }}"  />

    <!-- Custom CSS -->
	@yield('links')
	<style>
	@yield('css')
	</style>
</head>
<body style="background-image:url({{ URL::asset('/fireviewer/bglogin.jpg') }});">

	<header>
	@include('/inc/navbar')
	</header>

	<main>
	@yield('content')
	</main>

	<footer>
	@if(Route::current()->getName() != 'login')
		@if(Route::current()->getName() != 'register')
			@if(Route::current()->getName() != 'password.request')
					@include('/inc/footer')
			@endif
		@endif
	@endif
	</footer>



	<!-- TODO scripts externos -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

	<script type="text/javascript">
	@yield('js')
	</script>
</body>

</html>

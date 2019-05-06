<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> AlertViewer @yield('title')</title>
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
<body>

	<header>
	@include('/inc/navbar')
	</header>

	<main>
		@guest
		@yield('content')
		@else
<div id="wrapper" class="">
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
						<li class="sidebar-brand"> <a href="{{ route('dashboard') }}"> Todas las alertas <i class="fas fa-exclamation-triangle"></i></a> </li>
						<li> <a href="{{ route('categoria', 'incendio') }}">Fuegos<i class="fas fa-fire"></i></a></li>
						<li> <a href="{{ route('categoria', 'inundacion') }}">Inundaciones<i class="fas fa-water"></i></a> </li>
						<li> <a href="{{ route('categoria', 'terremoto') }}">Terremotos<i class="fas fa-house-damage"></i></a> </li>
						<li> <a href="{{ route('categoria', 'otro') }}">Otras alertas<i class="fas fa-clone"></i></a> </li>
				</ul>
		</div> <!-- /#sidebar-wrapper -->
		<!-- Page Content -->
		<div id="page-content-wrapper" style="margin-top: 90px;">
					@yield('content')
		</div> <!-- /#page-content-wrapper -->
		</div> <!-- /#wrapper -->
<!-- Bootstrap core JavaScript -->
@endguest
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
	<!-- SCRIPT MAPS -->
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5rNH_9DeGnfBvNc435hqkBvgz_m7cthc&callback=initMap">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script>
		$(function(){
			$("#menu-toggle").click(function(e) {
					e.preventDefault();
					$("#wrapper").toggleClass("toggled");
					if(document.getElementById("iconLayer").className == 'fas fa-times-circle') {
						document.getElementById("iconLayer").className = 'fas fa-layer-group';
					}
					else {
						document.getElementById("iconLayer").className = 'fas fa-times-circle';
					}
			});
		});
	</script>

	<script>
	$(document)
	  .ready(function () {
		var contentString = "";
			$.ajax({
					type: 'POST',
					url: "{{route('ajax.pendingNotices')}}",
					data: {_token: '{{csrf_token()}}' },
					success: function(data){
							if(data.notices.length == 0) {
								contentString = 'Sin avisos pendientes';
								document.getElementById("pendingNoticesDropdown").innerHTML = contentString;
								document.getElementById("numberOfPendingNotices").innerHTML = data.notices.length;
							}
							else {
									for (i = 0; i < data.notices.length; i++) {
										var URL = "{{URL("aviso")}}/"+data.notices[i].id;
											switch(data.notices[i].categoria) {
												case "incendio":
												contentString += '<a class="dropdown-item btn-outline-secondary" href="' + URL + '" id="link1"><i class="fas fa-fire mr-2"></i> Aviso ' + data.notices[i].id + '</a>';
													break;
												case "terremoto":
													contentString += '<a class="dropdown-item btn-outline-secondary" href="' + URL + '" id="link1"><i class="fas fa-house-damage mr-2"></i> Aviso ' + data.notices[i].id + '</a>';
													break;
												case "inundacion":
													contentString += '<a class="dropdown-item btn-outline-secondary" href="' + URL + '" id="link1"><i class="fas fa-water mr-2"></i> Aviso ' + data.notices[i].id + '</a>';
												break;
												case "otro":
													contentString += '<a class="dropdown-item btn-outline-secondary" href="' + URL + '" id="link1"><i class="fas fa-clone mr-2"></i> Aviso ' + data.notices[i].id + '</a>';
												break;
												default:
													contentString += 'error';
											}
									}
									document.getElementById("pendingNoticesDropdown").innerHTML = contentString;
									document.getElementById("numberOfPendingNotices").innerHTML = data.notices.length;
							}
					},
					error: function(jqxhr, status, exception) {
							 alert('Exception:' + exception,);
					 }
			});
	});
	</script>

	<script type="text/javascript">
	@yield('js')
	</script>
</body>

</html>

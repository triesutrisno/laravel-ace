<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Belajar Laravel</title>
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="{{url('/')}}">Home </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/about')}}">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/mahasiswa')}}">Mahasiswa</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/students')}}">Students</a>
					</li>
				</ul>
			</div>
		 </div>
	</nav>

	@yield('container')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
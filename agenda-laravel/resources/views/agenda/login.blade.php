<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Agenda</title>
	
</head>
<body>
	<h1>Login</h1>
	@if($mensaje)
	<div class="errors">
		<ul>
			<li>{{ $mensaje }}</li>
		</ul>
	</div>
@endif

	<form action="/agenda-laravel/public/agenda/login" method="post">
		<label for="nombre">Nombre:</label> <input maxlength="30"type="text" required name="nombre" value="{{old('nombre')}}">
		<br />
		<label for="precio">Contraseña:</label> <input maxlength="20" type="password" required name="pass" value="{{old('pass')}}">
		<br />
		<input type="submit" value="Login">
	</form>
			<form action="/agenda-laravel/public/agenda/registrarse" method="get">
	<input type="submit" value="Registrarse"/>
	</form>
</body>
</html>
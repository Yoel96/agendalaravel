<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Agenda</title>
	
</head>
<body>
	<h1>Registrarse</h1>
	@if($mensaje)
	<div class="errors">
		<ul>
			<li>{{ $mensaje }}</li>
		</ul>
	</div>
@endif
<h2>Introduzca el nombre de usuario y la contraseña de su usuario.</h2>
	<form action="/agenda-laravel/public/agenda/registrarse" method="post">
		<label for="nombre">Nombre:</label> <input maxlength="30" type="text" required name="nombre" value="{{old('nombre')}}">
		<br />
		<label for="precio">pass:</label> <input maxlength="20" type="text" required name="pass" value="{{old('pass')}}">
		<br />
		<input type="submit" value="Registrarse">
	</form>
			<form action="/agenda-laravel/public/agenda/login" method="get">
	<input type="submit" value="Volver"/>
	</form>
</body>
</html>
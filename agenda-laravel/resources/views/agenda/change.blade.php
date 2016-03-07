<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Agenda</title>
	
</head>
<body>
	<h1>Cambiar nota</h1>
	@if($mensaje)
	<div class="errors">
		<ul>
			<li>{{ $mensaje }}</li>
		</ul>
	</div>
@endif

	<form action="/agenda-laravel/public/agenda/change" method="post">
	<input type="hidden" value="{{$fecha}}" name="fecha-antigua"/>

	<input type="hidden" value="{{$id}}" name="id"/>

		Indice:		<br /><input maxlength="20" type="text" required name="indice" value="{{$indice}}">
		<br />
		Texto: 		<br /><textarea type="textarea" required name="nota" id="texto" value="">{{$nota}}</textarea>
		<br />
		Fecha:		<br /> <input type="date" required name="fecha"  value="{{$fecha}}">		<br />
		<input type="submit" value="Cambiar" >
	</form>
		<form action="/agenda-laravel/public/agenda/back" method="get">
	<input type="submit" value="Volver atras">
	</form>
</body>
</html>
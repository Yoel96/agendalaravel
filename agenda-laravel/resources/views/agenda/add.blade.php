<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agenda</title>
	<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body>
  



	<h1>Añadir nueva nota.</h1>
	@if($mensaje)
	<div class="errors">
		<ul>
			<li>{{ $mensaje }}</li>
		</ul>
	</div>
@endif

	<form action="/agenda-laravel/public/agenda/add" method="post">
		Indice:<br /><input maxlength="20"type="text" required name="indice" value="{{old('indice')}}"/>
		<br />
		Texto:<br /> <textarea type="textarea" required name="nota" id="texto"value="{{old('nota')}}"></textarea>
		<br />
		Fecha:<br /> <input type="date" required name="fecha" id="date" value="{{old('fecha')}}"/><br />
		<input type="submit" value="Añadir"  >
	</form>
			<form action="/agenda-laravel/public/agenda/back" method="get">
	<input type="submit" value="Volver atras">
	</form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Crear un producto</title>
</head>
<body>
	<h1>Crear un producto</h1>
	@if(count($errors) > 0)
		<div class="errors">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif

	<form action="/agenda-laravel/public/producto" method="post">
		<label for="nombre">Nombre:</label> <input type="text" name="nombre" value="{{old('nombre')}}">
		<br />
		<label for="descripcion">Descripción:</label> <input type="text" name="descripcion" value="{{old('descripcion')}}">
		<br />
		<label for="precio">Precio:</label> <input type="text" name="precio" value="{{old('precio')}}">
		<br />
		<input type="submit" value="Crear">
	</form>
</body>
</html>
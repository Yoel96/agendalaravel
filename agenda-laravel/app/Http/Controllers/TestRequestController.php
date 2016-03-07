<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestRequestController extends Controller
{
	public function store(Request $request)
{
    $this->validate($request, [
        'nombre' => 'required|max:255',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
    ]);

    echo 'Ahora sé que los datos están validados. Puedo insertar en la base de datos';
}

	
    public function create(Request $request)
{
    return view('producto.create');
}




    }

?>
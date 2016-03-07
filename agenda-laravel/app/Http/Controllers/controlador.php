<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo;
use DB;
class Controlador extends Controller
{

public  function controller($dato,Request $request){
	$modelo= new Modelo();
	switch($dato){
		case 'login':
		if($modelo->login($request)){
			echo $request->input("nombre");
			 return view('agenda.login',['usuario'=>$request->input("nombre"),'contraseña'=>$request->input("contraseña")]);

		}
		else{
			$mensaje='Usuario o contraseña no existe';
			echo $request->input("nombre");
		return view('agenda.login',['mensaje' =>$mensaje]);
		}
		break;
		
		case'loadChange':
		$notas =$modelo->loadChange( $request);
				
  return view('agenda.change',['id'=>$notas[0]->id_usuario,'nombre'=>$request->input("nombre"),'contraseña'=>$request->input("contraseña"),"mensaje"=>"",'nota'=>$notas[0]->nota,'fecha'=>$notas[0]->fecha,'indice'=>$notas[0]->indice]);
	
		break;
			case'change':
	if($modelo->change($request)){
			return view('agenda.change',['id'=>$request->input("nota"),'nombre'=>$request->input("nombre"),'contraseña'=>$request->input("contraseña"),"mensaje"=>"La fecha introducida ya ha pasado.",'nota'=>$notas[0]->nota,'fecha'=>$notas[0]->fecha,'indice'=>$notas[0]->indice]);
	
		}
		else{
		
		
			DB::update("update notas set nota ='".$request->input("nota")."', fecha='".$request->input("fecha-antigua")."',indice='".$request->input("indice")."'where fecha ='".$request->input("fecha-antigua")."' and id_usuario='".$request->input("id")."'", array());

		}
		break;
		case 'add':
		$modelo->add( $request);
		break;
	}
	
	
}
	
	
	
}
    
?>
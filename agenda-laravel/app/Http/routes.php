<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Controlador;
use Illuminate\Support\Facades\Session;
use App\Modelo;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::group(['middleware' => ['web']], function () {
   Route::get('agenda/add', function(Request $request){
	     return view('agenda.add',["mensaje"=>""]); });
    Route::post('agenda/login',function(Request $request){
		$modelo= new Modelo();
		if($modelo->login($request)){
			
			 return view('agenda.agenda');
		}
		else{
			$mensaje='Usuario o contraseña no existe';
			
		return view('agenda.login',['mensaje' =>$mensaje]);
		}
		
		
		
		
	});
	    Route::get('agenda/change',function(Request $request){
			
			$modelo= new Modelo();
			$notas =$modelo->loadChange( $request);	
  return view('agenda.change',['id'=>$notas[0]->id_usuario,"mensaje"=>"",'nota'=>$notas[0]->nota,'fecha'=>$notas[0]->fecha,'indice'=>$notas[0]->indice]);
	
		
		
	});
Route::post('agenda/change',function(Request $request){
		$modelo= new Modelo();
		if($modelo->change($request)){
			
			return view('agenda.agenda');

		}
		else{
		
		
return view('agenda.change',['id'=>$request->input("nota"),"mensaje"=>"Ya existe una nota en ese dia o el dia elegido ya ha pasado, por favor elija otra fecha.",'nota'=>$request->input("nota"),'fecha'=>$request->input("fecha"),'indice'=>$request->input("indice")]);
	}
		
	});
	
		Route::post('agenda/delete', function(Request $request){
		$modelo= new Modelo();
		$modelo->eliminar($request);
			return view('agenda.agenda');
		
	});
	
			Route::post('agenda/add', function(Request $request){
		$modelo= new Modelo();
		if($modelo->add( $request)){
			return view('agenda.agenda');}
		else{
	 return view('agenda.add',['mensaje'=>"Ya existe una nota en ese dia o el dia elegido ya ha pasado, por favor elija otra fecha."]);
	
		}
		
	});
    Route::get('agenda/login', function () {
		Session::flush();
    return view('agenda.login',['mensaje' =>""]);
});
  Route::get('agenda/back', function () {
		
    return view('agenda.agenda');
});
 Route::get('agenda/registrarse', function () {
		
    return view('agenda.registrarse',['mensaje' =>""]);
});
 Route::post('agenda/registrarse', function (Request $request) {
		$modelo=new Modelo();
		if($modelo->registrarse($request)){
			  return view('agenda.login',['mensaje' =>"Usuario registrado."]);
			
		}
		else{
    return view('agenda.registrarse',['mensaje' =>"El usuario introducido ya existe, por favor introduzca otros datos o entre con ese usuario."]);

		}
	});

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



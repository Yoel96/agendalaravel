<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class Modelo extends Model
{
	
 
	public function loadChange(Request $request)
{         
 
	
	$notas = DB::select("select * from notas where id_usuario=(select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."') and fecha='".$request->input("fecha")."'", array());

	return $notas;
	}
	
	
	
	public function change(Request $request){
		
	if($request->input("fecha-antigua")==$request->input("fecha")){
		
		DB::update("update notas set nota ='".$request->input("nota")."', fecha='".$request->input("fecha-antigua")."',indice='".$request->input("indice")."'where fecha ='".$request->input("fecha-antigua")."' and id_usuario='".$request->input("id")."'", array());
	return true;
		
	}
	else{
	$notas = DB::select("select * from notas where id_usuario=(select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."') and fecha='".$request->input("fecha")."'", array());
	
	
	if(count($notas)!=1){
	if ($request->input("fecha")!="0000-00-00"){
		
	if($request->input("fecha")>date("Y-m-d")){	
	DB::update("update notas set nota ='".$request->input("nota")."', fecha='".$request->input("fecha")."',indice='".$request->input("indice")."'where fecha ='".$request->input("fecha-antigua")."' and id_usuario='".$request->input("id")."'", array());
	return true;
	}else{
		

	return false;

		
	}
	}


}
else{
	
	return false;
}
	}
	}
	
	
	
	
	
	public function add(Request $request){
		
		if($request->input("fecha")<date("Y-m-d")){
			
	return false;
			
			
		}
		else{
		
		
		
	
	$notas = DB::select("select * from notas  where descatalogado='0' and id_usuario=(select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."') and fecha='".$request->input("fecha")."'", array());
if(count($notas)!=1){
		    $usuario = DB::select("select id from usuarios where nombre='".Session::get('usuario')."'and pass='". Session::get('pass')."'", array());
	
	
           	DB::insert("INSERT INTO `notas`(`nota`, `fecha`, `id_usuario`, `indice`,`descatalogado`) VALUES ('".$request->input("nota")."','".$request->input("fecha")."','".$usuario[0]->id."','".$request->input("indice")."','0')", array());
				 
return true;
	
}
else{
		return false;
}
		}
	
	}
	
	
	
public function eventos(){

		$notas = DB::select("select fecha,nota, indice from notas where descatalogado='0' and id_usuario in (select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."')", array());
        $dias="";
		$indices="";
		$texto="";
		for($i=0;$i<count($notas);$i++){
			if($i==0){
				$dias=$dias."'".$notas[$i]->fecha."'";
			$indices=$indices."'".$notas[$i]->indice."'";
			$texto=$texto."'".$notas[$i]->nota."'";
			}
			else{
			$dias=$dias.",'".$notas[$i]->fecha."'";
			$indices=$indices.",'".$notas[$i]->indice."'";
			$texto=$texto.",'".$notas[$i]->nota."'";}
		}
		$datos[0]=$dias;
		$datos[1]=$indices;
		$datos[2]=$texto;
		return $datos;
		}
		  
		  
			  public function eliminar(Request $request)
{        
	$notas = DB::select("select * from notas where id_usuario in (select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."') ", array());
for($i=0;$i<count($notas);$i++){
	
			
			DB::update("UPDATE notas SET descatalogado=true WHERE fecha='".$request->input('fecha')."' and id='".$notas[$i]->id."'", array());
	
		}
 

	
	}
		  
		  
		  public function depurador()
{        

	$notas = DB::select("select * from notas where id_usuario in (select id from usuarios where nombre='".Session::get('usuario')."'and pass='".Session::get('pass')."') ", array());
for($i=0;$i<count($notas);$i++){
			if($notas[$i]->fecha<date("Y-m-d")){
				
			DB::update("UPDATE notas SET descatalogado=true WHERE id='".$notas[$i]->id."'", array());
	}
		}
 

	
	}
	
	
	  public function login(Request $request)
{         

	$usuario = DB::select("select nombre, pass from usuarios where nombre='".$request->input("nombre")."'and pass='". $request->input("pass")."'", array());
	if(count($usuario)==1){
		Session::put('usuario', $request->input("nombre"));
	    Session::put('pass', $request->input("pass"));
	
		$this->depurador();
	
	
    return true;
	}
	else{
	
		
		return false;
	}
	
	}
	
	
	
	  public function registrarse(Request $request)
{         

	$usuario = DB::select("select nombre, pass from usuarios where nombre='".$request->input("nombre")."'and pass='". $request->input("pass")."'", array());
	if(count($usuario)==1){
		return false;
	}
	else{
	
		DB::insert("INSERT INTO usuarios(nombre, pass) VALUES ('".$request->input("nombre")."','".$request->input("pass")."')");
		return true;
	
	}
	
	}
	
}
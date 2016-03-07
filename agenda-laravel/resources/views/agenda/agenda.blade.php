<?php
use App\Modelo;
use Illuminate\Support\Facades\Session;
use Illuminate\Html\HtmlServiceProvider;
$modelo= new Modelo();


?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Agenda</title>
   <script language="JavaScript" type="text/javascript">
        
   var meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
	"Junio",
	"Julio",
	"Agosto",
	"Septiembre",
	"Octubre",
	"Noviembre",
	"Diciembre",
];
   var diasMes = [
    31,
     29,
     31,
   30,
    31,
	30,
	31,
	31,
	30,
	31,
	30,
	31,
];

  
  function cargaEventos(){
	  	var d = new Date();
	  var notas=[<?php echo $modelo->eventos()[1];?>]
	 var fecha=[<?php echo $modelo->eventos()[0];?>]
	 
var td="";
	 for(var i=0;i<notas.length;i++){
		 if(fecha[i].split("-")[1]==(d.getUTCMonth()+1)&&fecha[i].split("-")[0]==d.getFullYear()){
		  td+="<tr><td>"+fecha[i]+"</td><td>"+notas[i]+"</td></tr>"
	 }
		  
	  }
	  document.getElementById("proxEventos").innerHTML="<tr><td colspan='2'>Proximos eventos</td></tr>"+td;
	  
  }
  
  
	  function cambioMes(boton){
		  document.getElementById("atras").disabled=false;
		  	var d = new Date();
	   var dias="<tr><td>L</td><td>M</td><td>W</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>";
	     var año=document.getElementById("mes").innerHTML.split(" ")[2];
	  var contador=1;
	  var posicion=1;
       var proxDias=[<?php echo $modelo->eventos()[0];?>];
	   if(boton==">"){
	     for(var i=0;i<meses.length;i++){
			
			if(meses[i]==document.getElementById("mes").innerHTML.split(" ")[0]){

		        
				posicion=i+1;
				
				
				document.getElementById("mes").innerHTML=meses[posicion]+" de "+año;
				break;
				
				
			
			}
			 
			
			 
	   }}
	   else{
		    for(var i=0;i<meses.length;i++){
			
			if(meses[i]==document.getElementById("mes").innerHTML.split(" ")[0]){

		        
				posicion=i-1;
				
				
				document.getElementById("mes").innerHTML=meses[posicion]+" de "+año;
				break;
				
				
			
			}
		   
	   }}
	   
		 posicion++
		var mes=posicion-1

	   if(mes>11){
					posicion=1;
					mes=0;
					año=(parseInt(document.getElementById("mes").innerHTML.split(" ")[2])+1);
					document.getElementById("mes").innerHTML=meses[mes]+" de "+año;
					
				}
				
		 if(mes<0){
					posicion=12;
					mes=11;
					año=(parseInt(document.getElementById("mes").innerHTML.split(" ")[2])-1);
					document.getElementById("mes").innerHTML=meses[mes]+" de "+año;
					
				}		
				
				
	 
		  for(var i=1;i<=diasMes[mes];i++){
			  
		   controlador=true;
		   for(var j=0;j<proxDias.length;j++){
			  
		   if(i==proxDias[j].split("-")[2]&&proxDias[j].split("-")[1]==(posicion)&&proxDias[j].split("-")[0]==año){
			   if(i<10){ dias+="<td onclick='seleccion(this.id)' style='color:green'id=0"+i+">"+i+"</td>" }
			   else{
			   dias+="<td onclick='seleccion(this.id)' style='color:green'id="+i+">"+i+"</td>" 
			   }
			
			contador++;
				controlador=false;			   
		   }
		       if(contador%8==0){
			   contador=1;
			   dias+="</tr><tr>"
			   
			   
		   }
		   }
		   if(controlador){
		   dias+="<td id="+i+">"+i+"</td>"
		   contador++;
		   if(contador%8==0){
			   contador=1;
			   dias+="</tr><tr>"
			   
			   
		   }
		   }
		   
		   
		   
	   }
	
	   if(document.getElementById("mes").innerHTML.split(" ")[0]==meses[d.getUTCMonth()]){
		   
		     document.getElementById("atras").disabled=true;
	   }
		 document.getElementById("dias").innerHTML=dias;
	 
		  
	  }
	  
   function cargaDias(){
	   document.getElementById("atras").disabled=true;
	      
	var d = new Date();
	   var dias="<tr><td>L</td><td>M</td><td>W</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>";
	  var contador=1;
	
       var proxDias=[<?php echo $modelo->eventos()[0];?>];
	   
	   for(var i=1;i<=diasMes[d.getUTCMonth() ];i++){
		   controlador=true;
		   
		   
		   
		   
		   for(var j=0;j<proxDias.length;j++){
			 
		   if(i==proxDias[j].split("-")[2]&&proxDias[j].split("-")[1]==(d.getUTCMonth()+1)&&proxDias[j].split("-")[0]==d.getFullYear()){
			  if(i<10){ dias+="<td onclick='seleccion(this.id)' style='color:green'id=0"+i+">"+i+"</td>" }
			   else{
			   dias+="<td onclick='seleccion(this.id)' style='color:green'id="+i+">"+i+"</td>" 
			   }
			contador++;
				controlador=false;			   
		   }
		       if(contador%8==0){
			   contador=1;
			   dias+="</tr><tr>"
			   
			   
		   }
		   
		   
		   }
		   
		   
		   
		   
		   
		   if(controlador){
		   dias+="<td id="+i+">"+i+"</td>"
		   contador++;
		   if(contador%8==0){
			   contador=1;
			   dias+="</tr><tr>"
			   
			   
		   }
		   }
		   
		   
		   
	   }
	   
		dias+="</tr>";

		document.getElementById("dias").innerHTML=dias;
	   document.getElementById("mes").innerHTML=meses[d.getUTCMonth()]+" de "+d.getFullYear();
	   
   }
   
   
   function seleccion(dia){
	    
		   var indice=[<?php echo $modelo->eventos()[1];?>]
	 var fecha=[<?php echo $modelo->eventos()[0];?>]
	 var texto=[<?php echo $modelo->eventos()[2];?>]
	 alert
	 if((meses.indexOf(document.getElementById("mes").innerHTML.split(" ")[0])+1)<10){
	 
	    document.getElementById("fecha-cambio").value=document.getElementById("mes").innerHTML.split(" ")[2]+"-0"+( meses.indexOf(document.getElementById("mes").innerHTML.split(" ")[0])+1)+"-"+dia;
             document.getElementById("fecha-eliminar").value=document.getElementById("mes").innerHTML.split(" ")[2]+"-0"+( meses.indexOf(document.getElementById("mes").innerHTML.split(" ")[0])+1)+"-"+dia;
		 
	 }
	 else{	    document.getElementById("fecha-cambio").value=document.getElementById("mes").innerHTML.split(" ")[2]+"-"+( meses.indexOf(document.getElementById("mes").innerHTML.split(" ")[0])+1)+"-"+dia;
   document.getElementById("fecha-eliminar").value=document.getElementById("mes").innerHTML.split(" ")[2]+"-"+( meses.indexOf(document.getElementById("mes").innerHTML.split(" ")[0])+1)+"-"+dia;

	 }
   
   for(var i=0;i<texto.length;i++){
	  
	   if(document.getElementById("fecha-cambio").value==fecha[i])
	   {
		   document.getElementById("texto").value=texto[i];
		      document.getElementById("indice").value=indice[i];
		       document.getElementById("fecha").value=fecha[i];
		   
	   }
	   
   }
	 document.getElementById("cambio").disabled=false;
      document.getElementById("eliminar").disabled=false;   
   }
   
   
   
</script>	
	
	</head>
<body onload="cargaDias();cargaEventos()">

	<h1>Agenda</h1>
	<h2>Bienvenido <?php echo Session::get('usuario')?></h2>
<div id="calendario">
	<div id="botones">
		<input type ="button" onclick="cambioMes('<');" id="atras"value="<"/>
	<div colspan="2"id="mes"></div>
	<input type ="button" onclick="cambioMes('>')" id="adelante"value=">"/>
</div>

	
	<table id="dias">
	
	
	</table>
	
	<table id="proxEventos">

	
	</table>
	
	<form action="/agenda-laravel/public/agenda/login" method="get">
	<input type="submit" value="Salir de la sesión.">
	</form>
	</div>
	<div id="notas">
	<h3>Indice</h3><input readonly type="text" id="indice"/><br/>
	<h3>Texto</h3><textarea readonly type="text" id="texto"></textarea><br/>
	<h3>Fecha</h3><input  readonly type="text" id="fecha"/><br/>
		
	
	<form action="/agenda-laravel/public/agenda/change" method="get">
	<input type="hidden" value="" name="fecha"id="fecha-cambio"/>
	<input type="submit" value="Cambiar evento" id="cambio"disabled>
	</form>
	<form action="/agenda-laravel/public/agenda/delete" method="post">
	<input type="hidden" value="" name="fecha"id="fecha-eliminar"/>
	<input type="submit" value="eliminar" id="eliminar" disabled>
	</form>

	<form action="/agenda-laravel/public/agenda/add" method="get">
	<input type="submit" value="Añadir evento">
	</form>
	</div>
	
</body>
</html>
/**
 * @author Irving
 * 
 * Utilizamos el objeto XMLHttpRequest para hacer peticiones al servidor sin necesidad de recargar toda una página web.
 * También, creamos la función llamada Pagina(numPagina), la recibirá un valor correspondiente a un número de página y
 * se enlazará con el archivo mostarCodigosPostales.php para procesar ese número de página. Y el resultado se mostrará en la capa 
 * (<div id=”contenido”>.
 */

function objetoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function Pagina(numPagina){
	//Div en el que se mostrará los registros
	divContenido = document.getElementById('contenido');
	
	ajax = objetoAjax();
	/**
	 * Utilizamos el método GET e indicamos el archivo que realizará el proceso de paginar,
	 * junto con un valor que representa el número de página. 
	 */
	ajax.open("GET", "mostarCodigosPostales.php?pag="+numPagina);
	divContenido.innerHTML = "<img src='algo.gif'>";
	ajax.onreadystatechange = function(){
		if(ajax.readyState==4){
			//Se muestran los resultados en esta capa
			divContenido.innerHTML = ajax.responseText
		}
	} 
	
	// Al ulilizar el métdo GET colocamos null ya que enviamos el valor por la url ?pag=numPagina
	ajax.send(null)
}

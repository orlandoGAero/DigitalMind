<?php

require "../../config.php";
require "../../model.php";


if($_REQUEST['nombre_linea']!="" & $_REQUEST['nombre_linea']!=" " & $_REQUEST['nombre_linea']!="  ")
{

	function agregarL()
			{
				if (!isset($_REQUEST['nombre_linea'])) {
					throw new Exception("Página no encontrada", 1);
				}
	        
	                $idLinea=$_REQUEST['idLinea'];
	                $nombreL=$_REQUEST['nombre_linea'];
	               /* $activo=$_REQUEST['activo'];*/

					
				$objLinea = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$objLinea->addLinea($idLinea,$nombreL/*,$activo*/);			
			
			}

	$ejecuta=agregarL();
/*echo" <script> alert('El registro ha sido ingresado correctamente') 
window.location='index.php?url=listaLinea';
				 	</script> ";*/
}/*else{
	
	echo"<h2 align='justify'>El campo esta vacío, favor de verificar</h2><br>
	 <center><a href='index.php?url=listaMarca'> <img src='images/advertencia.jpg' width='35px' height='35px'></a></center>";

}*/
else{
	echo" <script> alert('campo invalido, favor de verificar') 
		window.location='index.php?url=listaLinea';
		</script> ";
}

?>

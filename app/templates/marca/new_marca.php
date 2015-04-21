<?php

require "../../config.php";
require "../../model.php";


if($_REQUEST['nombreM']!="" & $_REQUEST['nombreM']!=" " & $_REQUEST['nombreM']!="  ")
{

	function agregarM()
			{
				if (!isset($_REQUEST['nombreM'])) {
					throw new Exception("Página no encontrada", 1);
				}
	        
	                $idMarca=$_REQUEST['idMarca'];
	                $nombreM=$_REQUEST['nombreM'];
	               /* $activo=$_REQUEST['activo'];*/

					
				$objMarca = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$objMarca->addMarca($idMarca,$nombreM/*,$activo*/);			
			
			}

	$ejecuta=agregarM();
/*echo" <script> alert('El registro ha sido ingresado correctamente') 
window.location='index.php?url=listaMarca';
				 	</script> ";*/
}/*else{
	
	echo"<h2 align='justify'>El campo esta vacío, favor de verificar</h2><br>
	 <center><a href='index.php?url=listaMarca'> <img src='images/advertencia.jpg' width='35px' height='35px'></a></center>";

}*/
else{
	echo" <script> alert('campo invalido, favor de verificar') 
		window.location='index.php?url=listaMarca';
		</script> ";
}

?>

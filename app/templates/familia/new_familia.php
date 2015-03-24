<?php

require "../../config.php";
require "../../model.php";


if($_REQUEST['nombre_fam']!="" & $_REQUEST['nombre_fam']!=" " & $_REQUEST['nombre_fam']!="  ")
{

	function agregarF()
			{
				if (!isset($_REQUEST['nombre_fam'])) {
					throw new Exception("Página no encontrada", 1);
				}
	        
	                $idFam=$_REQUEST['idFamilia'];
	                $nombreF=$_REQUEST['nombre_fam'];
	               /* $activo=$_REQUEST['activo'];*/

					
				$objFamilia = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$objFamilia->addFamilia($idFam,$nombreF/*,$activo*/);			
			
			}

	$ejecuta=agregarF();
/*echo" <script> alert('El registro ha sido ingresado correctamente') 
window.location='index.php?url=listaFam';
				 	</script> ";*/

}/*else{
	
	echo"<h2 align='justify'>El campo esta vacío, favor de verificar</h2><br>
	 <center><a href='index.php?url=listaFam'> <img src='images/advertencia.jpg' width='35px' height='35px'></a></center>";

}*/
else{
	echo" <script> alert('campo invalido, favor de verificar') 
		window.location='index.php?url=listaFam';
		</script> ";
}
?>

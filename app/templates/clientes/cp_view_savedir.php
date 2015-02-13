<?php

require "../../config.php";
require "../../model.php";

function agregarDir()
		{
			if (!isset($_REQUEST['id_cp'])) {
				throw new Exception("Página no encontrada", 1);
			}
        
                $iddir=$_REQUEST['id_dir'];
                $calle=$_REQUEST['calle'];
                $num_ext=$_REQUEST['next'];
                $num_int=$_REQUEST['nint'];
                $col=$_REQUEST['colonia'];
                $ref=$_REQUEST['ref'];
                $idcp=$_REQUEST['id_cp'];

				
			$objdir = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$objdir->addDir($iddir,$calle,$num_ext,$num_int,$col,$ref,$idcp);			
		
		}


$holo=agregarDir();

echo "Exito!!!"

?>
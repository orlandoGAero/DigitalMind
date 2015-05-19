<?php
	// definir array bidimensional
	$AgregarCont[] = array();
	//se inicia el valor de a, que generara nuevas posiciones al array a partir de 0
	$a = 0;
	foreach ($obtContactos as $item) {
		if (in_array($item, $Cont_Prov)){

		}
		//En caso de que el contacto no este en la lista de asignados
    	else{
			//se agregara el valor del array de $item(Contactos que no tienen relacion con el cliente actual) al nuevo array
	      	$AgregarCont[$a]=$item;
	        //se incrementa el valor de a para nuevos posibles contactos
	    	$a++;    
    	}
	}

	//Comprobar que existan contactos
	if(isset($AgregarCont[0]['id_contacto']))
	{ /*-------CERRAR ISSET*/
		//Registros que se mostraran por pagina, en la tabla
    	$RegMostrar = 5;

    	// valores recibidos con get
    	if (isset($_GET['pag'])) {
    		$RegStart = ($_GET['pag']-1)*$RegMostrar;
    		$pagActual = $_GET['pag'];
    	}
    	else {
    		/*iniciamos los valores*/
    		$RegStart = 0;
    		$pagActual =1;
    	}

		$numReg = count($AgregarCont);
		$pagBack = $pagActual - 1;
		$pagNext = $pagActual + 1;
		$pagFin = $numReg/$RegMostrar;

		$res = $numReg%$RegMostrar;
?>

		<div id="datos_contact">
			<?php /*if ($obtContactos['listcontacto'] !=NULL) :*/?>	
				<div class="table-responsive">
					<!-- "id" para incluir los estilos a la tabla -->
					<table class="table" id="miTabla">
						<caption>Contactos</caption>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>&Aacute;rea</th>
								<th>M&oacute;vil</th>
								<th>Elegir</th>
							</tr>
						</thead>

						<?php
							// foreach ($obtContactos['listcontacto'] as $contacto) :
							// $idContact = $contacto['id_contacto'];
							$result = array_slice($AgregarCont,$RegStart,$RegMostrar);

							for ($i=0; $i < count($result); $i++) { 
						?>

							<tr>
								<td>
									<?php 
									  echo $result[$i]['nombreCon']." "
										  .$result[$i]['ap_paterno']." "
										  .$result[$i]['ap_materno'] 
									?>
								</td>
								<td><?php echo $result[$i]['nombre_area'] ?></td>
								<td><?php echo $result[$i]['movil'] ?></td>
								<td>
									<?php	
									echo"<form action= '#' method='POST' enctype='application/x-www-form-urlencoded' name='frmaddC$i' id='frmaddC$i' target='_self'>
											<input type='text' name='txt_idCon' disabled value='".$result[$i]['id_contacto']."'/> 
											<input type='text' name='txt_idproveedor' disabled value='".$claveProvee."'/> 
											<!-- botón de tabla contactos -->
											<input type='button' class='boton2 agregarCont' name='btnAddContacto' value='Agregar'/>
										</form>
								</td>
							</tr>";
						} ?>
					</table>
				</div>
			</div>
				
			<?php
					/*Muestra la paginacion de la tabla*/
					if($res>0)
					{
						$pagFin = floor($pagFin)+1;
					}

					if($pagActual>1)
					{
						echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddCa' id='frmaddCa' target='_self'>
								<input type = 'hidden' value = '1' name = 'pag' id= 'pag'>
								<input type='button' name='change' class='change' value='Primera'/>
							  </form>";

						/*Para ir a la pagina anterior*/
						echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddCb' id='frmaddCb' target='_self'>
								<input type = 'hidden' value = '$PagBack' name = 'pag' id= 'pag'>
								<input type='button' name='change' class='change' value='<<'/>
							  </form>";  
					}

					/*para la paginacion*/
		 			for($i=1;$i<=$pagFin;$i++) 
		    		{
			     		/*muestra las pagina anteriores a la actual*/
			     			if($i<$pagActual)
			     			{
								echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddC$i' id='frmaddC$i' target='_self'>
										<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
										<input type='button' name='change' class='change' value='$i'/>
									  </form>";    
			     			}
			     		

			     		/*Muestra la pagina actual*/
			       		if($i==$pagActual) 
			       		{ 
			           		echo "<input type='button' value='".$pagActual."'/>";
			        	}
			     		
			     		/*Muestra las paginas siguientes a  la actual*/
			     		if($i>$pagActual)
			     		{
			         		echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddC$i' id='frmaddC$i' target='_self'>
									<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
									<input type='button' name='change' class='change' value='$i'/>
								  </form>";
			     		}
		    		} /*end for*/

		    		if($pagActual<$pagFin)  
		    		{
						/*Muestra el boton siguiente*/    
						echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddCc' id='frmaddCc' target='_self'>
								<input type = 'hidden' value = '$pagNext' name = 'pag' id= 'pag'>
								<input type='button' name='change' class='change' value='>>'/>
							  </form>";
						
						/*muestra el boton para ir a la ultima pagina*/
						echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmaddCd' id='frmaddCd' target='_self'>
								<input type = 'hidden' value = '$pagFin' name = 'pag' id= 'pag'>
								<input type='button' name='change' class='change' value='Ultima'/>
							  </form>";
				  	}
				} /* fin osset*/
				else {
					echo "<pre class='azul'>
							<h3>No exiten contactos registrados</h3>
						  </pre>";
				}
			?>
		

<script type="text/javascript">
	 $(function () {
        $('.agregarCont').click(function () {
                formdc = this.form;
                $('#datos_contact').load('index.php?url=InsertarContacto&txt_idCon=<?php echo $result[$i]['id_contacto']; ?>&txt_idproveedor=<?php echo $claveProvee ?>&',$(formdc).serialize());
            });
    });

	 //funcion para cambiar pagina mejorado xD

	$(function () {
		$('.change').click(
			function () {
				formulario = this.form;
			$('#allcontact').load('index.php?url=TablaContactos&pag=',$(formulario).serialize());
		});
	});   
</script>
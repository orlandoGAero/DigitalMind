<?php 
	/* define el array bidimensional */
	$AgregarContactos[]=array();
	/* se inicia el valor de k, que generara nuevas posiciones al array a partir de */
	$k = 0;
	foreach ($obtContactos['listcontacto'] as $tablaContact) {
	/* verifica si $item aparece en contactos */
		if (in_array($tablaContact, $Contactos_Prov)) {
			# code...
		} 
		/*En caso de que el contacto no este en la lista de asignados*/
		else {
			/*se agregara el valor del array de $tablaContact(Contactos que no tienen relacion con el proveedor actual) al nuevo array*/
	    	$AgregarContactos[$k]=$tablaContact;
	        /*se incrementa el valor de k para nuevos posibles contactos*/
	    	$k++;    
	    }
	}
?>

<div id="datos_contact">
	<?php if ($obtContactos['listcontacto'] !=NULL) :?>	
		<div class="table-responsive">
			<!-- "id" para incluir los estilos a la tabla -->
			<?php echo $claveProvee ?>
			<table class="table" id="miTabla">
				<caption>Contactos</caption>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>&Aacute;rea</th>
						<th>M&oacute;vil</th>
						<th>Elegir</th>
					</tr>
				</thead>

				<?php
					foreach ($obtContactos['listcontacto'] as $contacto) :
					$idContact = $contacto['id_contacto'];
				?>

					<tr>
						<td><?php echo $contacto['nombreCon'] ?></td>
						<td><?php echo $contacto['ap_paterno'] ?></td>
						<td><?php echo $contacto['ap_materno'] ?></td>
						<td><?php echo $contacto['nombre_area'] ?></td>
						<td><?php echo $contacto['movil'] ?></td>
						<td>	
							<form action="#" method='POST' enctype='application/x-www-form-urlencoded' target="_self">
								<input type="TEXT" name="txt_idCon" disabled value="<?php echo $idContact; ?>"/> 
								<input type="hidden" name="txt_idproveedor" disabled value="<?php echo $claveProvee; ?>"/> 
								<!-- botón de tabla contactos -->
								<input type="button" class="boton2 agregarCont" name="btnAddContacto" value="Agregar"/>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<?php else :?>
			<pre class='azul'>
				<h3>No exiten contactos registrados</h3>
			</pre>
	<?php endif; ?>
</div>

<script type="text/javascript">
	 $(function () {
        $('.agregarCont').click(function () {
                formdc = this.form;
                $('#datos_contact').load('index.php?url=DatosContacto&div=addContacto&idcon=<?php echo $idContact; ?>&txt_idproveedor=<?php echo $claveProvee ?>&',$(formdc).serialize());
            });
    });
</script>
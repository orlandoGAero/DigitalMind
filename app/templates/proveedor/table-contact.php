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
						<form>
							
							<input type="text" name="txt_idCon" disabled value="<?php echo $idContact; ?>"/> 
							<input type="text" name="txt_idproveedor" disabled value="<?php echo $claveProvee?>"/> 
							<!-- botón de tabla contactos -->
							<input type="submit" class="boton2" name="btnAddContacto" id="btnAddContacto" value="Agregar"/>
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
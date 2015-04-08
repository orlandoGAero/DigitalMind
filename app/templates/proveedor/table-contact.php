<?php if ($obtContactos['listcontacto'] !=NULL) :?>	
	<div class="table-responsive">
		<!-- "id" para incluir los estilos a la tabla -->
		<table class="table" id="miTabla">
			<caption>Contactos</caption>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Área</th>
					<th>Móvil</th>
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
							<input type="text" name="txt_IDProv" value="<?php echo $parametrosProveedores['idprov'] ?>"> 
							<input type="text" name="txt_idCon" value="<?php echo $idContact ?>"> 
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
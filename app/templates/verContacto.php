<?php ob_start() ?>
	<?php $obtenerDatosContacto['id_contacto'] ?>
	
	<h1>Detalle de Contacto</h1>
	<br />
	<table border="1">
		<tr>
			<td>
				<table class="" id="miTabla">
					<caption>Contacto</caption>
					<tr>
						<th>Nombre</th>
						<td><?php  echo $detalleContacto['nombreCon'] ?></td>
					</tr>
					<tr>
						<th>Apellido Paterno</th>
						<td><?php echo $detalleContacto['ap_paterno'] ?></td>
					</tr>
					<tr>
						<th>Apallido Materno</th>
						<td><?php echo $detalleContacto['ap_materno'] ?></td>
					</tr>
					<tr>
						<th>Área</th>
						<td><?php echo $detalleContacto['nombre_area'] ?></td>
					</tr>
					<tr>
						<th>Móvill</th>
						<td><?php echo $detalleContacto['movil'] ?></td>
					</tr>
					<tr>
						<th>Télefono Oficina</th>
						<td><?php echo $detalleContacto['tel_oficina'] ?></td>
					</tr>
					<tr>
						<th>Télefono Emergencia</th>
						<td><?php echo $detalleContacto['tel_emergencia'] ?></td>
					</tr>
					<tr>
						<th>Correo Institucional</th>
						<td><?php echo $detalleContacto['correo_instu'] ?></td>
					</tr>
					<tr>
						<th>Correo Personal</th>
						<td><?php echo $detalleContacto['correo_p'] ?></td>
					</tr>
					<tr>
						<th>Facebook</th>
						<td><?php echo $detalleContacto['facebook'] ?></td>
					</tr>
					<tr>
						<th>Twitter</th>
						<td><?php echo $detalleContacto['twitter'] ?></td>
					</tr>
					<tr>
						<th>Skype</th>
						<td><?php echo $detalleContacto['skype'] ?></td>
					</tr>
					<tr>
						<th>Página Web</th>
						<td><?php echo $detalleContacto['direccion_web'] ?></td>
					</tr>
				</table>
			</td>
			<td width="25%"></td>
			<td>
				<table class="" id="miTabla">
					<caption>Dirección</caption>
					<tr>
						<th>Calle</th>
						<td><?php echo $detalleContacto['calle'] ?></td>
					</tr>
					<tr>
						<th>Número Exterior</th>
						<td><?php echo $detalleContacto['num_ext'] ?></td>
					</tr>
					<tr>
						<th>Número Interior</th>
						<td><?php echo $detalleContacto['num_int'] ?></td>
					</tr>
					<tr>
						<th>Colonia</th>
						<td><?php echo $detalleContacto['colonia'] ?></td>
					</tr>
					<tr>
						<th>Referencia</th>
						<td><?php echo $detalleContacto['referencia'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>
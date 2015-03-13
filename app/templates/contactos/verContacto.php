<?php ob_start() ?>
	<?php $obtenerDatosContacto['id_contacto'] ?>
	
	<section id="principal">
		<h1>Detalle de Contacto</h1>
		<br />
		
		<div class="table-responsive">
			<div class="columns_left">
				<table id="miTabla" >
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
					<?php if($detalleContacto['whatsapp'] == "Si") :?>
						<tr>
							<th>Móvill</th>
							<td><?php echo $detalleContacto['movil'] ?> <img src="images/whatsapp-icono.png" title="WhatsApp"/></td>
						</tr>
					<?php else :?>
						<tr>
							<th>Móvill</th>
							<td><?php echo $detalleContacto['movil'] ?></td>
						</tr>
					<?php endif; ?>
					<tr>
						<th>Ext.</th>
						<td><?php echo $detalleContacto['extension'] ?></td>
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
			</div>
		
			<div class="columns_right">
				<table id="miTabla" >
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
						<td>
							<?php if ($detalleContacto['num_int'] == 0) :?>
								<?php echo $detalleContacto['num_int'] = "S/N" ?>
							<?php  else :?>
								<?php echo $detalleContacto['num_int'] ?>
							<?php endif; ?>
							</td>
					</tr>
					<tr>
						<th>Colonia</th>
						<td><?php echo $detalleContacto['colonia'] ?></td>
					</tr>
					<tr>
						<th>Código Postal</th>
						<td><?php  echo $detalleContacto['codigoP'] ?></td>
					</tr>
					<tr>
						<th>Localidad</th>
						<td><?php $detalleContacto['localidad'] = mb_strtoupper($detalleContacto['localidad']); echo $detalleContacto['localidad'] ?></td>
					</tr>
					<tr>
						<th>Municipio</th>
						<td><?php $detalleContacto['municipio'] = mb_strtoupper($detalleContacto['municipio']);  echo $detalleContacto['municipio'] ?></td>
					</tr>
					
					<tr>
						<th>Estado</th>
						<td><?php $detalleContacto['estado'] = mb_strtoupper($detalleContacto['estado']); echo $detalleContacto['estado'] ?></td>
					</tr>
					<tr>
						<th>Referencia</th>
						<td><?php echo $detalleContacto['referencia'] ?></td>
					</tr>
				</table>
			</div>
		</div>
	</section>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
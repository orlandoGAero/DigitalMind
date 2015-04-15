<?php ob_start() ?>
	
	<?php $obtenerDatosProveedor['id_prov'] ?>
	<div align="left"><a href="index.php?url=Proveedores"><img src="images/leftarrow.png" title="Regresar"></a></div>
	<h3 class="azul">Detalle del Proveedor</h3>
		<br />

	<div class="table-responsive">
		<div class="columns_left">
			<table id="miTabla" >
				<caption>Datos Proveedor</caption>
				<tr>
					<th>Proveedor</th>
					<td><?php echo $detProveedor['proveedor'] ?></td>
				</tr>
				<tr>
					<th>Categor&iacute;a</th>
					<td><?php echo $detProveedor['categoria'] ?></td>
				</tr>
				<tr>
					<th>Tel&eacute;fono</th>
					<td><?php echo $detProveedor['tel'] ?></td>
				</tr>
				<tr>
					<th>Direcci&oacute;n Web</th>
					<td><?php echo $detProveedor['dirweb'] ?></td>
				</tr>
			</table>
		</div>

		<div class="columns_left">
			<table id="miTabla" >
				<caption>Datos Fiscales</caption>
				<tr>
					<th>Raz&oacute;n Social</th>
					<td><?php echo $detProveedor['razon_social'] ?></td>
				</tr>
				<tr>
					<th>RFC</th>
					<td><?php echo $detProveedor['rfc'] ?></td>
				</tr>
				<tr>
					<th>Tipo de Raz&oacute;n</th>
					<td><?php echo $detProveedor['tipo_ra'] ?></td>
				</tr>
			</table>
		</div>

		<div class="columns_left">
			<table id="miTabla" >
				<caption>Direcci&oacute;n Fiscal</caption>
				<tr>
					<th>Calle</th>
					<td><?php echo $detProvDirFis['calle'] ?></td>
				</tr>
				<tr>
					<th>N&uacute;mero Ext</th>
					<td><?php echo $detProvDirFis['num_ext'] ?></td>
				</tr>
				<tr>
					<th>N&uacute;mero Int</th>
					<td><?php echo $detProvDirFis['num_int'] ?></td>
				</tr>
				<tr>
					<th>Colonia</th>
					<td><?php echo $detProvDirFis['colonia'] ?></td>
				</tr>
				<tr>
					<th>Referencia</th>
					<td><?php echo $detProvDirFis['referencia'] ?></td>
				</tr>
				<tr>
					<th>C.P.</th>
					<td><?php echo $detProvDirFis['codigoP'] ?></td>
				</tr>
				<tr>
					<th>Localidad</th>
					<td><?php echo $detProvDirFis['localidad'] ?></td>
				</tr>
				<tr>
					<th>Municipio</th>
					<td><?php echo $detProvDirFis['municipio'] ?></td>
				</tr>
				<tr>
					<th>Estado</th>
					<td><?php echo $detProvDirFis['estado'] ?></td>
				</tr>
			</table>
		</div>

		<div class="columns_right">
			<table id="miTabla" >
				<caption>Direcci&oacute;n</caption>
				<tr>
					<th>Calle</th>
					<td><?php echo $detProveedor['calle'] ?></td>
				</tr>
				<tr>
					<th>N&uacute;mero Ext</th>
					<td><?php echo $detProveedor['num_ext'] ?></td>
				</tr>
				<tr>
					<th>N&uacute;mero Int</th>
					<td><?php echo $detProveedor['num_int'] ?></td>
				</tr>
				<tr>
					<th>Colonia</th>
					<td><?php echo $detProveedor['colonia'] ?></td>
				</tr>
				<tr>
					<th>Referencia</th>
					<td><?php echo $detProveedor['referencia'] ?></td>
				</tr>
				<tr>
					<th>C.P.</th>
					<td><?php echo $detProveedor['codigoP'] ?></td>
				</tr>
				<tr>
					<th>Localidad</th>
					<td><?php echo $detProveedor['localidad'] ?></td>
				</tr>
				<tr>
					<th>Municipio</th>
					<td><?php echo $detProveedor['municipio'] ?></td>
				</tr>
				<tr>
					<th>Estado</th>
					<td><?php echo $detProveedor['estado'] ?></td>
				</tr>
			</table>
		</div>

		<div class="columns_left" >
			<table id="miTabla" >
				<caption>Datos Bancarios</caption>
					<tr>
						<th>Banco</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['nombre_banco'] ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th>Sucursal</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['sucursal'] ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th>Titular</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['titular'] ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th>No.Cuenta</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['no_cuenta'] ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th>Clabe Interbancaria</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['no_cuenta_interbancario'] ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th>Tipo de cuenta</th>
						<?php foreach($detDatosBancarios['datosbank'] as $detDB) : ?>
							<td><?php echo $detDB['tipo_cuenta'] ?></td>
						<?php endforeach; ?>
					</tr>
			</table>
		</div>

		<div class="columns_right">
			</br></br></br></br></br></br>
			<table id="miTabla" >
				<caption>Contactos</caption>
				<tr>
					<th>Nombre</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['nombreCon'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Apellido Paterno</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['ap_paterno'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Apellido Materno</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['ap_paterno'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>&Aacute;rea</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['nombre_area'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Tel&eacute;fono M&oacute;vil</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['movil'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Tel&eacute;fono Oficina</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['tel_oficina'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Tel&eacute;fono Emergencia</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['tel_emergencia'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Correo Personal</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['correo_p'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Correo Institucional</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['correo_instu'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Facebook</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['facebook'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Twitter</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['twitter'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Skype</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['skype'] ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Direcci&oacute;n Web</th>
					<?php foreach ($detProveedor_Cont['datoscontact_pro'] as $detDcon) : ?>
						<td><?php echo $detDcon['direccion_web'] ?></td>
					<?php endforeach; ?>
				</tr>
			</table>
		</div>
	</div> <!-- fin div table-responsive -->

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
<?php ob_start() ?>

	<h1>Detalle del Proveedor</h1>
		<br />

	<div class="columns_left">
		<table class="miTabla" >
			<caption>Datos Proveedor</caption>
			<tr>
				<th>Proveedor</th>
				<td></td>
			</tr>
			<tr>
				<th>Categor&iacute;a</th>
				<td></td>
			</tr>
			<tr>
				<td>Tel&eacute;fono</td>
				<td></td>
			</tr>
			<tr>
				<th>Direcci&oacute;n Web</th>
				<td></td>
			</tr>
		</table>
	</div>

	<div class="columns_left">
		<table class="miTabla" >
			<caption>Datos Fiscales</caption>
			<tr>
				<th>Raz&oacute;n Social</th>
				<td></td>
			</tr>
			<tr>
				<th>RFC</th>
				<td></td>
			</tr>
			<tr>
				<td>Tipo de Raz&oacute;n</td>
				<td></td>
			</tr>
		</table>
	</div>

	<div class="columns_right">
		<table class="miTabla" >
			<caption>Direcci&oacute;n</caption>
			<tr>
				<th>Calle</th>
				<td><?php echo ?></td>
			</tr>
			<tr>
				<th>N&uacute;mero Ext</th>
				<td></td>
			</tr>
			<tr>
				<th>N&uacte;mero Int</th>
				<td></td>
			</tr>
			<tr>
				<th>Colonia</th>
				<td></td>
			</tr>
			<tr>
				<th>Referencia</th>
				<td></td>
			</tr>
			<tr>
				<th>C.P.</th>
				<td></td>
			</tr>
			<tr>
				<th>Localidad</th>
				<td></td>
			</tr>
			<tr>
				<th>Municipio</th>
				<td></td>
			</tr>
			<tr>
				<th>Estado</th>
				<td></td>
			</tr>
		</table>
	</div>

	<div class="columns_left">
		<table class="miTabla" >
			<caption>Datos Bancarios</caption>
			<tr>
				<th>Banco</th>
				<td></td>
			</tr>
			<tr>
				<th>Sucursal</th>
				<td></td>
			</tr>
			<tr>
				<td>Titular</td>
				<td></td>hgvhgc
			</tr>
			<tr>
				<td>No.Cuenta</td>
				<td></td>
			</tr>
			<tr>
				<td>Clabe Interbancaria</td>
				<td></td>
			</tr>
			<tr>
				<td>Tipo de cuenta</td>
				<td></td>
			</tr>
		</table>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>

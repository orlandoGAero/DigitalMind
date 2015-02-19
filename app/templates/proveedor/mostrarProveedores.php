<?php ob_start() ?>
	
	<!DOCTYPE html>
	<html>
		<head>
			<!-- Style CSS tabla--> 
		    <link rel="stylesheet" type="text/css" href="css/style-table.css">
		</head>
		<body>
			<div align="right"><a href="index.php?url=NuevoProveedor"><img src="images/add-provider.png" alt="Nuevo Proveedor" title="Nuevo Proveedor"></a></div>
		
			<div class="table-responsive">
				<table class="table" id="miTabla">
					<caption>Proveedores</caption>
					<thead> 
						<tr>
							<th>ID</th>
							<th>Proveedor</th>
							<th>Razón Social</th>
							<th>RFC</th>
							<th>Municipio</th>
							<th>Estado</th>
							<th colspan="3">Operaciones</th>
						</tr>
					</thead>
					<?php 
						foreach ($obtenerDat['proveedores'] as $prov) :
							$idpro = $prov['id_prov'];
					?>
					<tr>
						<td><?php echo $prov['id_prov'] ?></td>
						<td><?php echo $prov['proveedor'] ?></td>
						<td><?php echo $prov['razon_social'] ?></td>
						<td><?php echo $prov['rfc'] ?></td>
						<td><?php echo $prov['municipio'] ?></td>
						<td><?php echo $prov['estado'] ?></td>
						<td><?php echo "<a href='index.php?url=DetalleProveedor&id_Proveedor=$idpro'>" ?> <img src='images/detalle.png' title="Detalle"></a></td>
						<td><?php echo "<a href=''><img src='images/editar.png'></a>"; ?></td>
						<td><?php echo "<a href=''><img src='images/eliminar.png'></a>";?></td>			
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</body>
	</html>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
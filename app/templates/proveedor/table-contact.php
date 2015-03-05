<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Style CSS tabla--> 
	<link rel="stylesheet" type="text/css" href="css/style-table.css">
	<!--<script type="text/javascript" src="js/jquery-1.4.2.min.js">
	$(function (obtdat) {
		$('#frmdtc').submit(function (obtdat) {
			obtdat.preventDefault()
			$('#accion').load('index.php?url=DatosContacto?' + $('frmdtc').serialize())
		})
	})
	</script>-->
</head>
<body>
	<div class="table-responsive">
		<form action="index.php?url=DatosContacto" method="GET" name="frmdtc" id="frmdtc" target="_self">
			<!-- "id" para incluir los estilos a la tabla -->
			<table class="table" id="miTabla">
				<caption>Contactos</caption>
				<thead>
					<!--<tr>
						<th colspan="7">
							<label>Buscar:</label>
							<input type="text"/>
						</th>
					</tr>-->
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
							<!-- <input type="checkbox" id="c1" name="c1"  value="<?php echo $idContact ?>" /> -->
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<input type="submit" value="Continuar"/>
		</form>
	</div>

	<div id="accion">prueba</div>
</body>
</html>
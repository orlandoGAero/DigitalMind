<!-- Style CSS tabla--> 
<link rel="stylesheet" type="text/css" href="css/style-table.css">
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
				<th>Correo Institucional</th>
				<th>Elegir</th>
			</tr>
		</thead>

		<?php
			foreach ($obtContactos['listcontacto'] as $contacto) :
			$Contact = $contacto['id_contacto'];
		?>

			<tr>
				<td><?php echo $contacto['nombreCon'] ?></td>
				<td><?php echo $contacto['ap_paterno'] ?></td>
				<td><?php echo $contacto['ap_materno'] ?></td>
				<td><?php echo $contacto['nombre_area'] ?></td>
				<td><?php echo $contacto['movil'] ?></td>
				<td><?php echo $contacto['correo_instu'] ?></td>
				<td align="center"><a href=""><img src="images/choose.png"></a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
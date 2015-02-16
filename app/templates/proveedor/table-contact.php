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
				<th>Móvill</th>
				<th>Télefono Oficina</th>
				<th>Correo Institucional</th>
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
				<td><?php echo $contacto['tel_oficina'] ?></td>
				<td><?php echo $contacto['correo_instu'] ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
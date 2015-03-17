<!-- Eliminar archivo -->
	<table class="table" id="miTabla">
			<tr>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Localidad</th>
				<th>CP</th>
			</tr>
	</table>
			
			<?php foreach ($obtenerDatosDireccion as $Dir) : ?>
				<tr>
					<td><?php echo $Dir['estado'] ?> <input type="text" name="state" readonly="readonly" value="<?php echo $Dir['estado'] ?>" /></td>
					<td><?php echo $Dir['municipio'] ?> <input type="text" name="municipality" readonly="readonly" value="<?php echo $Dir['municipio'] ?>" /></td>
					<td><?php echo $Dir['localidad'] ?> <input type="text" name="locality" readonly="readonly" value="<?php echo $Dir['localidad'] ?>" /></td>
					<td><?php echo $Dir['codigoP'] ?> <input type="text" name="codpo" readonly="readonly" value="<?php echo $Dir['codigoP'] ?>" /></td>
				</tr>
			<?php endforeach; ?>
	</table>

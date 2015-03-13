<?php if (isset($obtenerDatosDireccion[0]['localidad'])) :?>
	<table class="table" id="miTabla">
			<tr>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Localidad</th>
				<th>CP</th>
				<th>Elegir</th>
			</tr>
			
			<?php foreach ($obtenerDatosDireccion as $Dir) : ?>
				<tr>
					<td><?php echo $Dir['estado'] ?> <input type="hidden" name="state" readonly="readonly" value="<?php echo $Dir['estado'] ?>" /></td>
					<td><?php echo $Dir['municipio'] ?> <input type="hidden" name="municipality" readonly="readonly" value="<?php echo $Dir['municipio'] ?>" /></td>
					<td><?php echo $Dir['localidad'] ?> <input type="hidden" name="locality" readonly="readonly" value="<?php echo $Dir['localidad'] ?>" /></td>
					<td><?php echo $Dir['codigoP'] ?> <input type="hidden" name="codpo" readonly="readonly" value="<?php echo $Dir['codigoP'] ?>" /></td>
					<td><input type="radio" name="idcp-loc" value="<?php echo $Dir['id_cp'] ?>"/></td>
				</tr>
			<?php endforeach; ?>
	</table>
<?php endif ?>
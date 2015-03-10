<!-- <?php if (isset($obtenerDatosMun[0]['codigoP'])) :?> -->
	<table class="table" id="miTabla">
			<tr>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Localidad</th>
			</tr>
			
			<tr>
				<td><?php echo $obtenerDatosMun[0]['estado'] ?> <input type="hidden" name="state" readonly="readonly" value="<?php echo $obtenerDatosMun[0]['estado'] ?>" /> </td>
				<td><?php echo $obtenerDatosMun[0]['municipio'] ?> <input type="hidden" name="municipality" readonly="readonly" value="<?php echo $obtenerDatosMun[0]['municipio'] ?>" </td>
				<td><?php echo $obtenerDatosMun[0]['localidad'] ?> <input type="hidden" name="locality" readonly="readonly" value="<?php echo $obtenerDatosMun[0]['localidad'] ?>" </td>
			</tr>
	</table>
<!-- <?php endif ?> -->


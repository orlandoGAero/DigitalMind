<?php if (isset($obtenerDatosDir[0]['codigoP'])) :?>
	<table class="table" id="miTabla">
			<tr>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Localidad</th>
			</tr>
			
			<tr>
				<td><?php echo $codPost[0]['estado'] ?> <input type="hidden" name="state" readonly="readonly" value="<?php echo $codPost[0]['estado'] ?>" /> </td>
				<td><?php echo $codPost[0]['municipio'] ?> <input type="hidden" name="municipality" readonly="readonly" value="<?php echo $codPost[0]['municipio'] ?>" </td>
				<td>
					<select name="idcp-locality">
						<option value='0'>Seleccione una Opción</option>
						<?php foreach ($obtenerDatosDir as $locality) : ?>
								<option required='required' value="<?php echo $locality['id_cp'] ?>"> <?php echo $locality['localidad'] ?> </option> ?>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
	</table>
<?php endif ?>

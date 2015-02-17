<?php if (isset($obtenerDatosDir[0]['id_cp'])): ?>
	<?php $obtenerDatosDir[0]['id_cp'] ?>
	
	<b>Estado:</b> <?php echo $codPost[0]['estado'] ?>
	<br />
	<b>Municipio:</b> <?php echo $codPost[0]['municipio'] ?>
	<br />
	<b>Localidad</b>
		
	<select id="loc" name="locality" >
		<?php foreach ($obtenerDatosDir as $locality) : ?>
				<option value="<?php echo $locality['id_cp'] ?>"><?php echo $locality['localidad'] ?></option>
		<?php endforeach; ?>
	</select>
<?php endif ?>
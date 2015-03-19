<!-- Cargar select de municipio -->
<option value="" selected="selected">Seleccione una Opción</option>
<?php foreach ($obtenerDatosMun as $nameMunicipality) : ?>
		<option value="<?php echo $nameMunicipality['municipio'] ?>"> <?php echo $nameMunicipality['municipio'] ?> </option> ?>
<?php endforeach; ?>


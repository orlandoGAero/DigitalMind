
<option value="" selected="selected">Seleccione una Opción</option>
<?php foreach ($obtenerDatosMun as $Municip) : ?>
		<option value="<?php echo $Municip['municipio'] ?>"> <?php echo $Municip['municipio'] ?> </option> ?>
<?php endforeach; ?>


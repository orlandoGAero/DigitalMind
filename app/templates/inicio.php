<?php ob_start() ?>
	<!--<h6> <?php echo $obtenerDatos['fecha'] ?> </h6>-->
	
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
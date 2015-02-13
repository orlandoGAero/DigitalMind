<?php ob_start() ?>
	<!--Script para el paginado-->
	<script type="text/javascript" src="<?php echo 'js/'.config::$paging_js ?>"></script>
	
	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->
	
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para incluir los estilos a la tabla -->
    	<table class="table" id="miTabla"> 
			<thead>
				<tr>
					<th>CP</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Estado</th>
					<th>Operaciones</th>
				</tr>
			</thead>
			
			<?php 
				foreach ($obtenerDatos['codigos_postales'] as $codP) :
				$idCodPost = $codP['id_cp'];
				// Encriptamos el texto
				//$cp = Encrypter::encrypt("$idCodPost");
			?>
			
			<tr>
				<td><?php echo $codP['codigoP'] ?></td>
				<td><?php echo $codP['localidad'] ?></td>
				<td><?php echo $codP['municipio'] ?></td>
				<td><?php echo $codP['estado'] ?></td>
				<td>
					<?php echo "<a href='index.php?url=verCodPost&idCP=$idCodPost'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
					<a href="index.php?---------"><img src="images/editar.png" title="Modificar"/></a>
					<a href="index.php?---------"><img src="images/eliminar.png" title="Eliminar"/></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	
	<script type="text/javascript">
		var pager = new Pager('miTabla', 250);
		pager.init();
		pager.showPageNav('pager', 'NavPosicion');
		pager.showPage(1);
	</script>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>
<?php ob_start() ?>
<!--Script para el paginado-->
<script type="text/javascript" src="js/paging.js"></script>
<link rel="stylesheet" type="text/css" href="css/style-table.css">
<div id="busquedad" class="buscar">
	<table class="table-responsive">
		<tr>
			<td width="100%">
				<form name="formBusqueda" action="index.php?url=buscarFam" method="POST">
				<b class="azul">Buscar</b> <input type="search" name="busqueda" maxlength="50" required />
				</form>
				<td>
				<a href='index.php?url=agregarFam'><img src="images/add.png" width="25px" height="25px"/></a></td>
				<div id="resultado"></div>
			</td>	

		</tr>
	</table>
</div>
<?php if (count($crit['resultado'])>0): ?>
	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->
<div class='table-responsive'>
<table class="table" id="miTabla">
<thead>
	
	<th>Clave</th>
	<th>Nombre_familia</th>
	<th>Estatus</th>
	<th>Operaciones</th>
</thead>
<?php foreach ($crit['resultado'] as $criterio) : ?>
<tr>
		<?php echo"	<td>".$criterio['id_fam']."</td>";?>
			<td><?php echo $criterio['nombre_fam']?></td>
			<td><?php echo $criterio['activo']?></td>
			<td>
				<a href="index.php?url=verFam&id_fam=<?php echo $criterio['id_fam'] ?>"><img src="images/detalle.png"/></a>
				<a href="index.php?url=verFamMod&id_fam=<?php echo $criterio['id_fam'] ?>"><img src="images/editar.png"/></a>
				<a href="index.php?url=eliFam&id_fam=<?php echo $criterio['id_fam'] ?>"><img src="images/eliminar.png"/></a>
			</td>	
</tr>
    <?php endforeach; ?>
</table>
 <?php endif; ?>
</div>

	<script type="text/javascript">
	var pager = new Pager('miTabla', 4);
	pager.init();
	pager.showPageNav('pager', 'NavPosicion');
	pager.showPage(1);
</script>
	

	
<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

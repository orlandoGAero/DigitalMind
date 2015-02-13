<?php ob_start() ?>
<!--Script para el paginado-->
<script type="text/javascript" src="js/paging.js"></script>

<link rel="stylesheet" type="text/css" href="css/style-table.css">
	<table class="buscar">
		<tr>
			<td width="100%">
				<form name="formBusqueda" action="index.php?url=buscarXC" method="POST">
				<b class="azul">Buscar</b> <input type="text" name="busqueda" maxlength="50" required />
				</form>
				<td>
				<a href='index.php?url=agregarCl'><img src="images/add.png" width="25px" height="25px"/></a></td>
				<div id="resultado"></div>
			</td>	

		</tr>
	</table>

	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->
	
<div class='table-responsive'>
<table class="table" id="miTabla">
<caption>CLIENTES</caption>
<thead>
	
	<th>Clave</th>
	<th>Nombre</th>
	<th>Razon social</th>
	<th>RFC</th>
	<th>Municipio</th>
	<th>Estado</th>
	<th>Estatus</th>
	<th colspan="3">Operaciones</th>
</thead>
<?php foreach($obtenerCliente['m_clientes'] as $lisCliente):?>
<tr>
		
			<td><?php echo $lisCliente['id_cliente']?></td>
			<td><?php echo $lisCliente['nombre']?></td>
			<td><?php echo $lisCliente['razon_social']?></td>
			<td><?php echo $lisCliente['rfc']?></td>
			<td><?php echo $lisCliente['municipio']?></td>
			<td><?php echo $lisCliente['estado']?></td>
			<td><?php echo $lisCliente['activo']?></td>
			<td><a href="index.php?url=verCliente&id_cli=<?php echo $lisCliente['id_cliente'] ?>"><img src="images/detalle.png"/></a></td>
			<td><a href="index.php?url=modCl&id_cli=<?php echo $lisCliente['id_cliente'] ?>"><img src="images/editar.png"/></a></td>
			<td><a href="index.php?url=eli_cli&id_cli=<?php echo $lisCliente['id_cliente'] ?>"><img src="images/eliminar.png"/></a></td>
			</td>
		</tr>
		<?php endforeach; ?>
</table>

</div>


<script type="text/javascript">
var pager = new Pager('miTabla', 4);
pager.init();
pager.showPageNav('pager', 'NavPosicion');
pager.showPage(1);
</script>
	
<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>
<?php ob_start() ?>
<!--Script para el paginado-->
<script type="text/javascript" src="js/paging.js"></script>

<link rel="stylesheet" type="text/css" href="css/style-table.css">
	<table class="buscar">
		<tr>
			<td width="100%">
				<form name="formBusqueda" action="index.php?url=buscarXC" method="POST">
				<!--<input type="text" name="busqueda" placeholder="Ingresa Criterio" maxlength="100"/>-->
				<!--Carga el combo con las razones sociales existentes-->
				<?php echo"<select name='razonTipo'>
                   <option value='0'>Seleccione una Opción</option>";
				foreach($CargaCombo4 as $nombreRS): 										 
					echo "<option value=".$nombreRS['razon_social'].">".$nombreRS['id_datFiscal']."----". $nombreRS['razon_social']."</option>";
				endforeach; 
				echo "</select>";?>
				<input name="submit" type="submit" value="Buscar" class="boton2">				
				</form>
				<td>
				<a href='index.php?url=agregarCl'><img src="images/add.png" width="25px" height="25px"/></a></td>
				<div id="resultado"></div>
			</td>	

		</tr>
	</table>

<?php if (count($crit['resultado'])>0): ?>

	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->

<div class='table-responsive'>
<table class="table" id="miTabla">
<caption>Resultados de la busqueda</caption>
<thead>
	
	<th>Clave</th>
	<th>Nombre</th>
	<th>Fecha Alta</th>
	<th>Operaciones</th>
</thead>
<?php foreach ($crit['resultado'] as $criterio) : ?>
<tr>
		<?php echo"	<td>".$criterio['id_cliente']."</td>";?>
			<td><?php echo $criterio['nombre']?></td>
			<td><?php echo $criterio['fecha_alta']?></td>
			<td>
				<a href="index.php?url=verCliente&id_cli=<?php echo $criterio['id_cliente'] ?>"><img src="images/detalle.png"/></a>
				<a href="index.php?url=modCl&id_cli=<?php echo $criterio['id_cliente'] ?>"><img src="images/editar.png"/></a>
				<a href="index.php?url=eli_cli&id_cli=<?php echo $criterio['id_cliente'] ?>"><img src="images/eliminar.png"/></a>
			</td>	
</tr>
    <?php endforeach; ?>
</table>
 <?php endif; ?>
</div>


<!--Script para el paginado, con un rango de 4 x pagina-->
<script type="text/javascript">
var pager = new Pager('miTabla', 4);
pager.init();
pager.showPageNav('pager', 'NavPosicion');
pager.showPage(1);
</script>

<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>
<?php ob_start() ?>
<!-- Script de Tiny Table Sorter -->
<script type="text/javascript" src="js/tinyTableSorter.js"></script>

<script>
		function confirmar () {
		  msg = confirm('¿Desea Eliminar o Desactivar?');
		  return msg;
	  	}
</script>



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

	<!--<div id="NavPosicion"></div> Div donde se mostrara las opciones del paginado 1|2|3...-->
	<div id="controls">
			<div id="perpage">
				<select onchange="sorter.size(this.value)">
					<option value="5" selected="selected">5</option>
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				<span>Registros por página</span>
			</div>
			<div id="text">Página <b><span id="currentpage"></span></b> de <b><span id="pagelimit"></span></b></div>
			<div id="navpage">
				<img src="images/first.gif" width="16" height="16" alt="First Page" title="Primer Página" onclick="sorter.move(-1,true)" />
				<img src="images/previous.gif" width="16" height="16" alt="First Page" title="Anterior Página" onclick="sorter.move(-1)" />
				<img src="images/next.gif" width="16" height="16" alt="First Page" title="Siguiente Página" onclick="sorter.move(1)" />
				<img src="images/last.gif" width="16" height="16" alt="Last Page" title="Última Página" onclick="sorter.move(1,true)" />
			</div>
		</div>
		<br />
<div class='table-responsive'>
<table class="table sortable" id="miTabla">
<caption>CLIENTES</caption>
<thead>

	<!--<th>Clave</th>-->
	<th><h5>NOMBRE</th>
	<!--<th>Razon social</th>-->
	<th><h5>RFC</th>
	<th><h5>MUNICIPO</th>
	<th><h5>COLONIA</th>
	<th><h5>TÉLEFONO</th>
	<th><h5>CATEGORÍA</h5></th>
	<!--<th>Estado</th>-->
	<th><h5>ESTATUS</h5></th>
	<th colspan="3" class="nosort"><h5>Operaciones</h5></th>
</thead>
<?php foreach($obtenerCliente['m_clientes'] as $Cliente):?>
<tr>
				
			<td><?php echo $Cliente['nombre']?></td>
			<td><?php echo $Cliente['rfc']?></td>
			<td>
				<?php $Cliente['municipio'] = mb_strtoupper($Cliente['municipio']); ?>
				<?php echo  $Cliente['municipio'] ?>
			</td>
			<td><?php echo $Cliente['colonia']?></td>
			<td><?php echo $Cliente['t_movil']?></td>
			<td><?php echo $Cliente['categoria']?></td>
			<td><?php echo $Cliente['activo']?></td>
			<td><a href="index.php?url=verCliente&id_cli=<?php echo $Cliente['id_cliente'] ?>"><img src="images/detalle.png"/></a></td>
			<td><a href="index.php?url=modCl&id_cli=<?php echo $Cliente['id_cliente'] ?>"><img src="images/editar.png"/></a></td>
			<td><a href="index.php?url=eli_cli&id_cli=<?php echo $Cliente['id_cliente'] ?>" onclick='javascript:return confirmar();'><img src="images/eliminar.png"/></a></td>
			</td>
		</tr>
		<?php endforeach; ?>
</table>

</div>


<!-- Script para ordenar columnas, paginado y mostrar cierta cantidad de registros TINY Table Sorter -->
<script type="text/javascript">
	 var sorter = new TINY.table.sorter("sorter");
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		// sorter.evensel = "evenselected";
		// sorter.oddsel = "oddselected";
		sorter.pagesize = 5;
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("miTabla",1);
  	</script>
	
<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>
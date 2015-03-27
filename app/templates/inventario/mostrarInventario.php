<?php ob_start() ?>
	
	<div id="busquedad" class="buscar">
		<form name="formBusqInv">
			<ul>
				<li><b class="azul">Buscar por:</b>
					<a href="index.php?url=NuevoRegistro"><img src="images/add-inventario.png" alt="Nuevo Registro" title="Nuevo Registro" align="right"></a>
				</li>
				</br>
				<li>
					<label>campo</label>
					<input type="text"/>
				
					<label>campo2</label>
					<input type="text"/>

					<label>campo3</label>
					<input type="text"/>
				</li>
			</ul>
		</form>
	</div>

	<!-- div control de páginado -->
	<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
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
	</div> <!-- fin de div control de paginado -->
	<br>

	<div class="table-responsive">
		<table class="table sortable" id="miTabla">
			<caption>Inventario</caption>
			<thead>
				<tr>
					<th><h5>Proveedor</h5></th>
					<th><h5>Producto</h5></th>
					<th><h5>Transacci&oacute;n</h5></th>
					<th><h5>Factura</h5></th>
					<th><h5>Estado</h5></th>
					<th><h5>Status</h5></th>
					<th><h5>Ubicaci&oacute;n</h5></th>
					<th colspan="3" class="nosort">Operaciones</th>
				</tr>
			</thead>

				<script type="text/javascript">
					function eliminar ()
					{
						rc = confirm('¿Seguro que deseas Eliminar o Desactivar el registro?');
						return rc;
					}
				</script>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<!-- operaciones -->
					<td><?php echo "<a href='index.php?url='>" ?> <img src='images/detalle.png' title="Detalle"></a></td>
					<td><?php echo "<a href='index.php?url='>" ?> <img src='images/editar.png' title="Editar"></a></td>
					<td><?php echo "<a href='index.php?url='>" ?><img src='images/eliminar.png' title="Eliminar" onclick="javascript:return eliminar();"></a></td>
				</tr>
		</table>
	</div>

	<pre class='azul'>
		<h3>No exiten registros en el Inventario</h3></br><a href="index.php?url=NuevoRegistro"><img src="images/add-inventario.png" alt="Nuevo Registro" title="Nuevo Registro"></a>

 	</pre>

 	<!-- Script para ordenar columnas, paginado y mostrar cierta cantidad de registros TINY Table Sorter -->
	<script type="text/javascript">
	  var sorter = new TINY.table.sorter("sorter");
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		// sorter.evensel = "evenselected";
		// sorter.oddsel = "oddselected";
		sorter.pagesize = 10;
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("miTabla",1);
  	</script>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
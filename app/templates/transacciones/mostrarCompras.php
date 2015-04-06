<!-- Listar Compras -->
 <?php 
 	/**
	 * ob_start() envia todos los resultados del script desde la invocación de la función a un buffer interno. 
	 * Dichos resultados se recojen a través de la función ob_get_clean().
	 */
?>
<?php ob_start() ?>
		
	<!-- Script de Tiny Table Sorter -->
	<script type="text/javascript" src="<?php echo 'js/'.config::$tinyTableSorter_js ?>"></script>
	
	<?php if($obtenerDatosListCompras['compras'] != NULL) :?>
		<div id="busqueda" class="buscar">
			<form name="formBusqueda" method="POST" id="filtros" target="_self">
				<ul>
					<li><b class="azul">Buscar por:</b> <a href='index.php?url=transacciones'><img src="images/menu-nueva_trans.png" title="Nueva Transacción" align='right' width="54px" height="54px"/></a></li>
					<li>
						<input type="search" class="elementosBusqueda" name="numCompra" maxlength="50" placeholder="No. Compra" title="No. Compra" />
						<input type="search" class="elementosBusqueda" name="nomProveedor" maxlength="30" placeholder="Proveedor" title="Proveedor"/>
						<input type="date" class="elementosBusqueda" name="fechaCompra" min="2015-01-01" title="Fecha"/>
						<input type="text" class="elementosBusqueda" name="timefrom" placeholder="Hora" autocomplete="off" title="Formato de Hora: 00:00" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" />
						<input type="submit" class="boton2" value="Filtrar" name="btnFiltrar"/>
					</li>
				</ul>
			</form>			
		</div>
		
		<div id="resultadoBusqueda">
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
			</div>
			<br />
		<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
			<div class="table-responsive">
				<!-- <a href="index.php?url=listContact"><img src="images/table_refresh.png" title="Tabla principal" align='left' width="25px" height="25px" /></a> -->
				<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
					"id" para incluir los estilos a la tabla -->
		    	<table class="table sortable" id="miTabla">
		    		<caption>Compras</caption>
					<thead>
						<tr>
							<th><h5>No. Compra</h5></th>
							<th><h5>Proveedor</h5></th>
							<th><h5>Fecha</h5></th>
							<th><h5>Hora</h5></th>
							<th class="nosort"><h5>Operaciones</h5></th>
						</tr>
					</thead>			
					
					<?php 
						foreach ($obtenerDatosListCompras['compras'] as $transCompra) :
						$idTransCompra = $transCompra['no_trans_compra'];
					?>
						<tr>
							<?php 
								$noComprobCompr = $transCompra['no_trans_compra'];
								$longitud = strlen($noComprobCompr);
								$longMax = 3;
								for ($i=0; $i < $longMax; $i++) { 
									$noComprobCompr = "0".$noComprobCompr;
								}
							?>
							<td><?php echo $noComprobCompr ?></td>
							<td><?php echo $transCompra['proveedor'] ?></td>
							<td><?php echo $transCompra['fecha_compra'] ?></td>
							<td><?php echo $transCompra['hora_compra'] ?></td>
							<td>
								<?php echo "<a href='index.php?url=detalleCompra&numCompr=".$idTransCompra."&idPro=".$transCompra['id_prov']."'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	<?php else :?>
		<pre>
			<a href='index.php?url=transacciones'><img src="images/menu-nueva_trans.png" title="Nueva transacción" align='right' width="54px" height="54px"/></a>
			<h3 class="azul">No se encuentra registrada ninguna compra</h3>
		</pre>
	<?php endif; ?>
	
	<script type="text/javascript">
				
	// Script para ordenar columnas, paginado y mostrar cierta cantidad de registros TINY Table Sorter
	  var sorter = new TINY.table.sorter("sorter");
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		sorter.pagesize = 10;
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("miTabla",0);
  	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
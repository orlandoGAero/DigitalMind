<?php ob_start() ?>
		
			<script type="text/javascript" src="js/tinyTableSorter.js"></script>
					
			<?php 
			// var_dump($obtenerDat['proveedores']);

			if ($obtenerDat['proveedores'] !=NULL) :?>
				
				<div id="busqueda" class="buscar">
					<form name="formBusqInv" method="POST" id="filtrosProv" target="_self">
						<ul>
							<li><b class="azul">Buscar por:</b>
								<a href="index.php?url=NuevoProveedor"><img src="images/add-provider.png" alt="Nuevo Proveedor" title="Nuevo Proveedor" align="right"></a>
							</li>
							</br>
							<li>
								<input type="search" class="elementosBusqueda" placeholder="Proveedor"/>
								<input type="search" class="elementosBusqueda" placeholder="Raz&oacute;n Social"/>
								<input type="search" class="elementosBusqueda" placeholder="Rfc"/>
								<input type="search" class="elementosBusqueda" placeholder="Categor&iacute;a"/>
								<input type="search" class="elementosBusqueda" placeholder="Tel&eacute;fono"/>
								<input type="search" class="elementosBusqueda" placeholder="Direcci&oacute;n Web"/>
								<input type="search" class="elementosBusqueda" placeholder="Municipio"/>
								<input type="submit" class="boton2" name="btnFiltrar" value="Filtrar">
							</li>
						</ul>
					</form>
				</div>
				
				<div id="resultadoBusqueda">
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
						<a href="index.php?url=Proveedores"><img src="images/table_refresh.png" title="Tabla principal" align='left' width="25px" height="25px" /></a>
						<table class="table sortable" id="miTabla">
							<caption>Proveedores</caption>
							<thead> 
								<tr>
									<th><h5>ID</h5></th>
									<th><h5>Proveedor</h5></th>
									<th><h5>Raz&oacute;n Social</h5></th>
									<th><h5>RFC</h5></th>
									<th><h5>Categor&iacute;a</h5></th>
									<th><h5>Tel&eacute;fono</h5></th>
									<th><h5>Direcci&oacute;n Web</h5></th>
									<th><h5>Municipio</h5></th>
									<th colspan="3" class="nosort">Operaciones</th>
								</tr>
							</thead>
							<?php 
								foreach ($obtenerDat['proveedores'] as $prov) :
									$idpro = $prov['id_prov'];
							?>
								<script type="text/javascript">
									function eliminar ()
									{
										rc = confirm('¿Seguro que deseas Eliminar o Desactivar el registro?');
										return rc;
									}
								</script>
							<tr>
								<td><?php echo $prov['id_prov'] ?></td>
								<td><?php echo $prov['proveedor'] ?></td>
								<td><?php echo $prov['razon_social'] ?></td>
								<td><?php echo $prov['rfc'] ?></td>
								<td><?php echo $prov['categoria'] ?></td>
								<td><?php echo $prov['tel'] ?></td>
								<td><?php echo $prov['dirweb'] ?></td>
								<td><?php echo $prov['municipio'] ?></td>
								<td><?php echo "<a href='index.php?url=DetalleProveedor&id_Proveedor=$idpro'>" ?> <img src='images/detalle.png' title="Detalle"></a></td>
								<td><?php echo "<a href='index.php?url=EditarProveedores&id_Proveedor=$idpro'>" ?> <img src='images/editar.png' title="Editar"></a></td>
								<td><?php echo "<a href='index.php?url=BorrarProveedores&id_Proveedor=$idpro'>" ?><img src='images/eliminar.png' title="Eliminar" onclick="javascript:return eliminar();"></a></td>			
							</tr>
						<?php endforeach; ?>
						</table>
					</div>
				</div> <!-- end div resultadoBusqueda -->

				<?php else :?>
				<pre class='azul'>
					<h3>No exiten proveedores registrados</h3></br><a href='index.php?url=NuevoProveedor'><img src='images/add-provider.png' alt='Nuevo Proveedor' title='Nuevo Proveedor'></a>
 				</pre>
			<?php endif; ?>

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
<!--  -->
<!-- Script de Tiny Table Sorter -->
	<script type="text/javascript" src="<?php echo 'js/'.config::$tinyTableSorter_js ?>"></script>
	<?php echo $r = array_column($productAdd,$productAdd['id_detalle_compra']) ?>
<?php if($productAdd != NULL) :?>
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
			<div class="table-responsive">
				<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
					"id" para incluir los estilos a la tabla -->
		    	<table class="table sortable" id="miTabla">
		    		<caption>Productos Agregados</caption>
					<thead>
						<tr>
							<th><h5>Producto</h5></th>
							<th><h5>Precio</h5></th>
							<th><h5>Cantidad</h5></th>
							<th class="nosort"><h5>Eliminar</h5></th>
						</tr>
					</thead>			
					
					<?php $costoTotal = 0; ?>
					<?php var_dump($productAdd) ?>
					<?php for ($i = 0; $i < count($productAdd); $i++) :?>
						
						<?php $idPr = $productAdd['id_producto']; ?>
						
						<tr>
							<td><?php echo $productAdd['nombre_producto'] ?></td>
							<td>$<?php echo $productAdd['precio_unitario'] ?></td>
							<td><?php echo $productAdd['cant_producto_compra'] ?></td>
							<td>
								<!-- boton borrar -->
								<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='formBorrar<?php $i ?>' id='formBorrar<?php $i ?>' target='_self'>
								<!-- input hidden-->
								<input type="hidden"  name="idDetTransCompr" value="<?php echo $productAdd['id_detalle_compra'] ?>" id=""/>
								<input type="hidden"  name="folioCompra" value="<?php echo $productAdd['no_trans_compra'] ?>" id=""/>
								<input type="button" name="btnBorrar" class="boton2" value="Borrar">
								</form>
							</td>
						</tr>
						<?php $costoTotal = $costoTotal + $productAdd['precio_unitario'] ?>
					<?php endfor; ?>
				</table>
			</div>
		</div>
		<?php echo "<b>Total: $".$costoTotal."</b>"  ?>
<?php else :?>
	<pre>
		<h3 class="azul">No se encuentra agregado  ningún producto</h3>
	</pre>
<?php endif; ?>
<!--  -->
<?php if(isset($obtenerDatosProdAddVent)) :?>
	<?php if($obtenerDatosProdAddVent != NULL) :?>
		<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
		<div class="table-responsive">
			<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
				"id" para incluir los estilos a la tabla -->
	    	<table class="table" id="miTabla">
	    		<caption>Productos Agregados</caption>
				<thead>
					<tr>
						<th><h5>Proveedor</h5></th>
						<th><h5>Producto</h5></th>
						<th><h5>Precio</h5></th>
						<th><h5>Cantidad</h5></th>
						<th class="nosort"><h5>Eliminar</h5></th>
					</tr>
				</thead>			
				
				<?php $costoTotal = 0; ?>
				
				<?php foreach($obtenerDatosProdAddVent as $productAdd) :?>
					
					<?php $idPr = $productAdd['id_producto']; ?>
					
					<tr>
						<td><?php echo $productAdd['proveedor'] ?></td>
						<td><?php echo $productAdd['nombre_producto'] ?></td>
						<td>$<?php echo number_format($productAdd['precio_unitario'],2,'.',',') ?></td>
						<td><?php echo $productAdd['cant_producto_venta'] ?></td>
						<td>
							<!-- boton borrar -->
							<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='formBorrar' id='formBorrar' target='_self'>
							<!-- input hidden-->
							<input type="hidden"  name="idDetTransVent" value="<?php echo $productAdd['id_detalle_venta'] ?>" />
							<input type="hidden"  name="folioVenta" value="<?php echo $productAdd['no_trans_venta'] ?>" />
							<input type="hidden"  name="idProductoV" value="<?php echo $idPr ?>" />
							<input type="hidden"  name="cantProdV" value="<?php echo $productAdd['cant_producto_venta'] ?>" />
							<!-- Botón -->
							<input type="button" name="btnBorrar" class="boton2 borrarProducto" value="Borrar">
							</form>
						</td>
					</tr>
					<?php $costoTotal = $costoTotal + $productAdd['precio_unitario'] * $productAdd['cant_producto_venta'] ?>
				<?php endforeach; ?>
			</table>
		</div>
		<?php echo "<b>Total: $".number_format($costoTotal,2,'.',',')."</b>"  ?>
	<?php else :?>
		<pre>
			<h3 class="azul">No se encuentra agregado ningún producto</h3>
		</pre>
	<?php endif; ?>
<?php endif; ?>

<script type="text/javascript">
	$(function () {
			$('.borrarProducto').click(
				function () {
					formTransacionSegundo = this.form;
					$('#productosAgregados').load('index.php?url=deleteProdVenta&',$(formTransacionSegundo).serialize());
				}
			);
		});
</script>
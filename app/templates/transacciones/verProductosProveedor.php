<!-- Cargar select de productos -->
<?php if($obtenerDatosProductos != NULL) :?>
	<option value="" disabled="disabled">Seleccione producto</option>
	<?php foreach ($obtenerDatosProductos as $producto) :?>
		<option value="<?php echo $producto['id_producto'] ?>"><?php echo $producto['nombre_producto'] ?></option>
	<?php endforeach; ?>
<?php else :?>
	<option value="" disabled="disabled">No cuenta con productos, seleccione un proveedor diferente</option>
<?php endif; ?> 
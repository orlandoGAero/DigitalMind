<table class="table" id="miTabla">
	<tr><th>Modelo</th><td><?php echo $datosProducto['modelo'] ?></td></tr>
	<tr><th>Marca</th><td><?php echo $datosProducto['nombre_marca'] ?></td></tr>
	<tr><th>Familia</th><td><?php echo $datosProducto['nombre_fam'] ?></td></tr>
	<tr><th>Línea</th><td><?php echo $datosProducto['nombre_linea'] ?></td></tr>
	<tr><th>Subcategoria</th><td><?php echo $datosProducto['subCategoria'] ?></td></tr>
	<tr><th>Tipo Producto</th><td><?php echo $datosProducto['tipo_prod'] ?></td></tr>
	<tr><th>Unidad</th><td><?php echo $datosProducto['unidad'] ?></td></tr>
	<tr><th>Descripción</th><td><?php echo $datosProducto['descripcion'] ?></td></tr>
	<tr><th>Precio</th><td>$<?php echo number_format($datosProducto['precio_unitario'],2,'.',',') ?></td></tr>
</table>
<!-- <li><label>Modelo</label><input type="text" name="txtModelo" value="<?php echo $datosProducto['modelo'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Marca</label><input type="text" name="txtMarca" value="<?php echo $datosProducto['nombre_marca'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Familia</label><input type="text" name="txtFamilia" value="<?php echo $datosProducto['nombre_fam'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Línea</label><input type="text" name="txtLinea" value="<?php echo $datosProducto['nombre_linea'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Subcategoria</label><input type="text" name="txtSubcat" value="<?php echo $datosProducto['subCategoria'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Tipo Producto</label><input type="text" name="txtTipoProd" value="<?php echo $datosProducto['tipo_prod'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Unidad</label><input type="text" name="txtUnidad" value="<?php echo $datosProducto['unidad'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Existencia</label><input type="text" name="txtExistencia" value="<?php echo $datosProducto['existencia'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li>
<li><label>Descripción</label><textarea name="txtDescripcion" readonly="readonly" class="desabilitar"><?php echo $datosProducto['descripcion'] ?></textarea>&nbsp;&nbsp;&nbsp;</li>
<li><label>Precio unitario</label><input type="text" name="txtPrecioU" value="<?php echo $datosProducto['precio_unitario'] ?>" readonly="readonly" class="desabilitar" />&nbsp;&nbsp;&nbsp;</li> -->
<li><label>Cantidad</label><input type="text" name="txtCantProd" class="keysNumbers" required="required" /><span style="color: red;"><b>*</b></span></li>
<li><input type="submit" class="boton2" value="Agregar" name="btnAgregar" /></li>

<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('.keysNumbers').keypress(function(tecla) {
	        if(tecla.charCode < 48 || tecla.charCode > 57) return false;
	    });
	});
</script>
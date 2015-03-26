<?php echo $obtenerDatosProducto['id_producto'] ?>
<li><label>Modelo</label><input type="text" name="txtModelo" value="<?php echo $datosProducto['modelo']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Marca</label><input type="text" name="txtMarca" value="<?php echo $datosProducto['nombre_marca']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Familia</label><input type="text" name="txtFamilia" value="<?php echo $datosProducto['nombre_fam']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Línea</label><input type="text" name="txtLinea" value="<?php echo $datosProducto['nombre_linea']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Subcategoria</label><input type="text" name="txtSubcat" value="<?php echo $datosProducto['subCategoria']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Tipo Producto</label><input type="text" name="txtTipoProd" value="<?php echo $datosProducto['tipo_prod']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Unidad</label><input type="text" name="txtUnidad" value="<?php echo $datosProducto['unidad']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Existencia</label><input type="text" name="txtExistencia" value="<?php echo $datosProducto['existencia']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Descripción</label><input type="text" name="txtDescripcion" value="<?php echo $datosProducto['descripcion']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><label>Precio unitario</label><input type="text" name="txtPrecioU" value="<?php echo $datosProducto['precio_unitario']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li><input type="submit" class="boton2" value="Guardar" name="btnGuardar" /></li>
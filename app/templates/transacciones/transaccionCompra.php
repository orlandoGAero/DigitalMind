<li><label>No. Comprobante</label><input type="text" name="numCompra" value="<?php echo $parametrosCompra['noComprovanteC']  ?>" readonly />&nbsp;&nbsp;&nbsp;</li>
<li>
	<label>Proveedores</label>
	<select name="idProveedor" required="required" >
		<option value="" disabled="disabled">Seleccione proveedor</option>
		<?php foreach ($parametrosCompra['proveedores'] as $proveedor) :?>
			<option value="<?php echo $proveedor['id_prov'] ?>"><?php echo $proveedor['proveedor'] ?></option>
		<?php endforeach; ?>
	</select>
	<span style="color: red;"><b>*</b></span>
</li>
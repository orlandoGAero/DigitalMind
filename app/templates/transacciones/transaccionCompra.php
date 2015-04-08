<li><label>No. Comprobante</label><input type="text" name="numCompra" value="<?php echo $parametrosCompra['noComprovanteC']  ?>" readonly="readonly" class="desabilitar"/>&nbsp;&nbsp;&nbsp;</li>
<li>
	<label>Proveedores</label>
	<select name="idProveedor" required="required" >
		<?php if($parametrosCompra['proveedores'] != NULL) :?>
			<option value="" disabled="disabled" >Seleccione proveedor</option>
			<?php foreach ($parametrosCompra['proveedores'] as $proveedor) :?>
				<option value="<?php echo $proveedor['id_prov'] ?>"><?php echo $proveedor['proveedor'] ?></option>
			<?php endforeach; ?>
		<?php else :?>
			<option value="" disabled="disabled" >No hay proveedores asignados a algún producto</option>
		<?php endif; ?>
	</select>
	<span style="color: red;"><b>*</b></span>
</li>
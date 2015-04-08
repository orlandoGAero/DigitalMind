<li><label>No. Comprobante</label><input type="text" name="numVenta" value="<?php echo $parametrosVenta['noComprovanteV']  ?>" readonly="readonly" class="desabilitar"/>&nbsp;&nbsp;&nbsp;</li>
<li>
	<label>Clientes</label>
	<select name="idCliente" required="required" >
		<option value="" disabled="disabled" >Seleccione cliente</option>
		<?php foreach ($parametrosVenta['clientes'] as $cliente) :?>
			<option value="<?php echo $cliente['id_cliente'] ?>"><?php echo $cliente['nombre'] ?></option>
		<?php endforeach; ?>
	</select>
	<span style="color: red;"><b>*</b></span>
</li>
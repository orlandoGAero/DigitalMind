<?php
if($div==1){
/*Entra al div para mostrar en el formulario*/
?>
<script type="text/javascript">
    /*Funcion para Agregar Datos Bancarios*/
    			sam(function (e) {
				sam('#formBancario').submit(function (e) {
					e.preventDefault()
					sam('#datBancarios').load('index.php?url=nuevoDB&div=1&' + $('#formBancario').serialize())
              	})
			})
    sam('document').ready(function(){
	
        sam('#tabBancarios').load('index.php?url=nuevoDB&div=2&' + $('#formBancario').serialize())
    });    
                
</script>          

<form action="#" method="POST"  name="formBancario" id="formBancario" target="_self">
<table class="nuevo-pro ">
<tr><th>Clave</th><td><input type="text" name="idDatBank"   value="<?php echo $idDatBank; ?>"readonly class="form-control"/></td></tr>
<tr><th><label><b>Banco</b></label></th><td><?php echo"<select id='nombreB' name='nombreB' class='form-control'>
				 <option value='0'>Seleccione una Opción</option>";
					foreach($CargaCombo2 as $comboB): 										 
				echo "<option value=".$comboB['id_banco'].">". $comboB['nombre_banco']."</option>";
					endforeach; 
				echo "</select> </td></tr>";?>
				
		<tr><th><label><b>Sucursal</b></label></th><td><input type="text" name="sucursal" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" maxlength="30" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		<tr><th><label><b>Titular</b></label></th><td><input type="text" name="titular" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" maxlength="30" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		<tr><th><label><b>No. Cuenta</b></label></th><td><input type="text" name="n_cuenta" onkeypress='return justNumbers(event);' class="form-control" required="required" maxlength="4" /></td></tr>
		<tr><th width="50px"><label><b>C.Interbancaria</b></label></th><td><input type="text" name="n_claveInterbancaria" onkeypress='return justNumbers(event);' maxlength="4" class="form-control" required="required"/></td></tr>
		<tr><th><label><b>Tipo Cuenta</b></label></th><td><?php echo"<select name='tipo_c' class='form-control'>
		 <option value='0'>Seleccione una Opción</option>";
					foreach($CargaCombo3 as $comboTP): 										 
				echo "<option value=".$comboTP['id_tipo_cuenta'].">". $comboTP['tipo_cuenta']."</option>";
					endforeach; 
				echo "</select> </td></tr>";?>
		</table><br>
<input type="hidden" name="idCliente" value="<?php echo $idcli;?>">            
<input type="submit" class="boton2" value="Continuar" name="Guardar" />
			</form>
<?php
        /*Fiin del If*/
}
if($div==2){
    /*Tabla con contenido*/
?>
    
<table class="table" id="miTabla"><tr>
        <th>Titular</th>
        <th>Banco</th>
        <th>Sucursal</th>
        <th>Cuenta</th>
        <th>Cuenta Inter.</th>
        <th>Tipo</th>
        </tr>
    <?php
if(isset($TableBanco)){
foreach($TableBanco as $table): 
 
echo "<tr>
<td>".$table['titular']."</td>
<td>".$table['nombre_banco']."</td>
<td>".$table['sucursal']."</td>
<td>".$table['no_cuenta']."</td>
<td>".$table['no_cuenta_interbancario']."</td>
<td>".$table['tipo_cuenta']."</td>

</tr>";

endforeach; 
} 
else{
    echo "<tr> <td><h2>No Hay Dat Fiscales</h2></td></tr>";    
}
        
        ?>    
        
    </table>

<?php
}
?>                            

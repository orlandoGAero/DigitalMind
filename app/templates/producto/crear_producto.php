<?php ob_start() ?>
<?php if (isset($Producto['mensaje'])) :?>
    <b><span style="color: red;"><?php echo $Producto['mensaje'] ?></span></b>
  <?php endif; ?>


<script>
  <!--Script para la validación numerica en input="cp"-->
    function justNumbers(e)
    {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum <= 8) || (keynum == 46))
    return true;
     
    return /\d/.test(String.fromCharCode(keynum));
    }
</script>

  <div class="container">
    <div class="row">
     <h1><a href="index.php?url=listaProducto" title="Salir"><img src="images/salir.png" height="20px" /></a>Nuevo Producto</h1>
      <div class="fondo"></div>
        <div class="col-md-6 col-md-offset-3">
          <ul class="nav-tabs" >
            <dd>
            <table class="table table-responsive">             
              <form action="index.php?url=agregarProd" method="POST"  name="formProd" id="formProd" target="_self">

              <tr><th></th><td><input type="hidden" name="idProd" value="<?php echo $Producto['idProd']?>" readonly class="form-control">
              <tr><th>Producto</th><td><input type="text" name="nomP" required class="form-control" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" ></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Modelo</th><td><input type="text" name="modelo" required class="form-control" ></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Marca</th><td><?php echo"<select name='marca' class='form-control'>
                  <option value='0'>Seleccione una Opción</option>";
                  foreach($CargaCombo8 as $comboMarca):                      
                    echo "<option value=".$comboMarca['id_marca'].">". $comboMarca['nombre_marca']."</option>";
                  endforeach; 
                  echo "</select>";?>
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Categoria</th><td><?php echo"<select name='familia' class='form-control'>
                   <option value='0'>Seleccione una Opción</option>";
                   foreach($CargaCombo9 as $comboFam):                      
                      echo "<option value=".$comboFam['id_fam'].">". $comboFam['nombre_fam']."</option>";
                   endforeach; 
                   echo "</select>";?>
             </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Línea</th><td><?php echo"<select name='linea' class='form-control'>
      					  <option value='0'>Seleccione una Opción</option>";
      						foreach($CargaCombo10 as $comboLinea): 										 
      							echo "<option value=".$comboLinea['id_linea'].">". $comboLinea['nombre_linea']."</option>";
      						endforeach; 
      				  	echo "</select>";?>            
                </td><td><span class="span"><b>&nbsp;*</b></span></td></tr> 
              <tr><th>Subcategoría</th><td><?php echo"<select name='subcatego' class='form-control'>
          				<option value='0'>Seleccione una Opción</option>";
          				foreach($CargaCombo15 as $comboSubcat): 										 
          					echo "<option value=".$comboSubcat['id_subCat'].">". $comboSubcat['subcategoria']."</option>";
          				endforeach; 
          				echo "</select>";?>
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Tipo</th><td><?php echo"<select name='tipoProd' class='form-control'>
          				<option value='0'>Seleccione una Opción</option>";
          				foreach($CargaCombo14 as $comboTProd): 										 
          				  echo "<option value=".$comboTProd['id_tipoProd'].">". $comboTProd['tipo_prod']."</option>";
          				endforeach; 
          			   echo "</select>";?>
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>     
              <tr><th>Unidad</th><td><?php echo"<select name='unidad' class='form-control'>
                  <option value='0'>Seleccione una Opción</option>";
                  foreach($CargaCombo12 as $comboUni):                     
                    echo "<option value=".$comboUni['id_unidad'].">". $comboUni['unidad']."</option>";
                  endforeach; 
                  echo "</select>";?>
             </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Proveedor</th><td><?php echo"<select name='proveedor' class='form-control'>
                  <option value='0'>Seleccione una Opción</option>";
                  foreach($CargaCombo16 as $comboProv):                     
                    echo "<option value=".$comboProv['id_prov'].">". $comboProv['proveedor']."</option>";
                  endforeach; 
                  echo "</select>";?>            
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Existencia</th><th>
                  <input type="text" name="exis" onkeypress='return justNumbers(event);' class='form-control' autocomplete="off" required>  
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Descripción</th><td>
                  <textarea name="desc" class="form-control" required></textarea></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><th>Precio Unitario</th><th>
                  <input type="text" name="precioU" onkeypress='return justNumbers(event);' class='form-control' autocomplete="off" required>  
              </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
              <tr><td>
                <button type="submit" class="btn btn-primary"><strong>Guardar</strong></button></td><td>
                <button type="reset" class="btn"><strong>limpiar</strong></button>
                </td></tr>      		
  </th></tr></form></table>
  </dd></ul></div></div></div>

   
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

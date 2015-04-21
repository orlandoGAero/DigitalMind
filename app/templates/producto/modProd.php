<?php ob_start() ?>
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
  <!-- css Formulario Listas Desplegables-->
  <link rel="stylesheet" href="css/estilos.css" />
  <div class="container">
    <div class="row">
     <h1><a href="index.php?url=listaProducto" title="Salir"><img src="images/salir.png" height="20px" /></a>Modificar Producto</h1>
      <div class="fondo"></div>
         <div class="col-lg-14">

         <div class="col-xs-9">
          <ul class="nav-tabs" >
            <dd>
            <table class="table table-responsive">             
             <?php echo" <form action='index.php?url=verProdMod&id_producto=".$ObtenerDatosProducto['id_producto']."' method='POST' id='formContact' target='_self' >"; ?>

              <tr><th>Clave</th><td><input type="text" name="id_producto" value="<?php echo $ObtenerDatosProducto['id_producto']?>" readonly class="form-control"></td></tr>
              <tr><th>Producto</th><td><input type="text" name="nomP" value="<?php echo $ObtenerDatosProducto['nombre_producto']?>" required class="form-control" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" ></td></tr>
              <tr><th>Modelo</th><td><input type="text" name="modelo" value="<?php echo $ObtenerDatosProducto['modelo']?>" required class="form-control"></td></tr>
              <tr><th>Marca</th><td><select name='marca' class='form-control'>      
              <?php if($ObtenerDatosProducto['nombre_marca'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_marca'] ?>"><?php echo $ObtenerDatosProducto['nombre_marca'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosMarca['marcas'] as $marcas) : ?>
              <option required='required' value="<?php echo $marcas['id_marca'] ?>"> <?php echo $marcas['nombre_marca'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>
              <tr><th>Categoria</th><td><select name='familia' class='form-control'>
              <?php if($ObtenerDatosProducto['nombre_fam'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_fam'] ?>"><?php echo $ObtenerDatosProducto['nombre_fam'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosFam['familias'] as $fams) : ?>
              <option required='required' value="<?php echo $fams['id_fam'] ?>"> <?php echo $fams['nombre_fam'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

              <tr><th>Línea</th><td><select name='linea' class='form-control'>
                <?php if($ObtenerDatosProducto['nombre_fam'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_linea'] ?>"><?php echo $ObtenerDatosProducto['nombre_linea'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosLinea['lineas'] as $lineas) : ?>
              <option required='required' value="<?php echo $lineas['id_linea'] ?>"> <?php echo $lineas['nombre_linea'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

              <tr><th>Subcategoría</th><td><select name='subcatego' class='form-control'>
              <?php if($ObtenerDatosProducto['subcategoria'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_subCat'] ?>"><?php echo $ObtenerDatosProducto['subcategoria'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosSubC['subcatego'] as $subC) : ?>
              <option required='required' value="<?php echo $subC['id_subCat'] ?>"> <?php echo $subC['subcategoria'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

              <tr><th>Tipo</th><td><select name='tipoProd' class='form-control'>
              <?php if($ObtenerDatosProducto['tipo_prod'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_tipoProd'] ?>"><?php echo $ObtenerDatosProducto['tipo_prod'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosTP['tipoProd'] as $TP) : ?>
              <option required='required' value="<?php echo $TP['id_tipoProd'] ?>"> <?php echo $TP['tipo_prod'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

              <tr><th>Unidad</th><td><select name='unidad' class='form-control'>
                <?php if($ObtenerDatosProducto['unidad'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_unidad'] ?>"><?php echo $ObtenerDatosProducto['unidad'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosUn['unidades'] as $TP) : ?>
              <option required='required' value="<?php echo $TP['id_unidad'] ?>"> <?php echo $TP['unidad'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

               <tr><th>Proveedor</th><td><select name='proveedores' class='form-control'>
              <?php if($ObtenerDatosProducto['proveedor'] != "") :?>
              <option value="<?php echo $ObtenerDatosProducto['id_prov'] ?>"><?php echo $ObtenerDatosProducto['proveedor'] ?></option>
              <?php else :?>
              <option value='0'>Seleccione una Opción</option>
              <?php endif; ?>
                <?php foreach ($obtenerDatosProv['proveedores'] as $Prov) : ?>
              <option required='required' value="<?php echo $Prov['id_prov'] ?>"> <?php echo $Prov['proveedor'] ?> </option> ?>
              <?php endforeach; ?>
              </select></td></tr>

              <tr><th>Existencia</th><th>
                  <input type="text" name="exis" onkeypress='return justNumbers(event);' value="<?php echo $ObtenerDatosProducto['existencia']?>"  class='form-control' autocomplete="off" required>  
              </td></tr>
              <tr><th>Descripción</th><td>
                  <textarea name="desc" class="form-control" required><?php echo $ObtenerDatosProducto['descripcion']?> </textarea></td></tr>
              <tr><th>Precio Unitario</th><th>
                  <input type="text" name="precioU" onkeypress='return justNumbers(event);' value="<?php echo $ObtenerDatosProducto['precio_unitario']?>"  class='form-control' autocomplete="off" required>  
              </td></tr>
              <tr><td>
                <button type="submit" class="btn btn-primary"><strong>Guardar</strong></button>
              </td></tr>          
  </th></tr></form></table>
  </dd></ul></div></div></div>

   
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

<?php ob_start() ?>
  <div class="container">
    <div class="row">
     <h1><a href="index.php?url=listaProducto" title="Salir"><img src="images/salir.png" height="20px" /></a>Detalle Producto</h1>
      <div class="fondo"></div>
        <div class="col-md-6 col-md-offset-3">
          <ul class="nav-tabs" >
            <dd>
            <table class="table table-responsive">      
              <tr><th>Clave</th><td><input type="text" name="idProd" value="<?php echo $lisPro['id_producto']?>"readonly class="form-control"/></td></tr>
              <tr><th>Producto</th><td><input type="text" value="<?php echo $lisPro['nombre_producto']?>" readonly class="form-control"/></td></tr>
              <tr><th>Modelo</th><td><input type="text" name="modelo" value="<?php echo $lisPro['modelo']?>" readonly class="form-control"></td></tr>
              <tr><th>Marca</th><td><input type="text" value="<?php echo $lisPro['nombre_marca']?>" readonly class="form-control"/></td></tr>
              <tr><th>Familia</th><td><input type="text" value="<?php echo $lisPro['nombre_fam']?>" readonly class="form-control"/></td></tr>
              <tr><th>Linea</th><td><input type="text" value="<?php echo $lisPro['nombre_linea']?>" readonly class="form-control"/></td></tr>
              <tr><th>SubCategoria</th><td><input type="text" value="<?php echo $lisPro['subcategoria']?>" readonly class="form-control"/></td></tr>
              <tr><th>Tipo</th><td><input type="text" value="<?php echo $lisPro['tipo_prod']?>" readonly class="form-control"/></td></tr>
              <tr><th>Unidad</th><td><input type="text" value="<?php echo $lisPro['unidad']?>" readonly class="form-control"/></td></tr>
              <tr><th>Proveedor</th><td><input type="text" value="<?php echo $lisPro['proveedor']?>" readonly class="form-control"/></td></tr>
              <tr><th>Existencia</th><td><input type="text" value="<?php echo $lisPro['existencia']?>" readonly class="form-control"/></td></tr>
              <tr><th>Descripcion</th><td><textarea value="<?php echo $lisPro['descripcion']?>" readonly class="form-control"/><?php echo $lisPro['descripcion']?></textarea></td></tr>
              <tr><th>Precio Unitario</th><td><input type="text" value="<?php echo $lisPro['precio_unitario']?>" readonly class="form-control"/></td></tr>
              </table>
          </dd>
        </ul>
      </div>
    </div>
  </div>	
	
	
	
	
	
	
	
	

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

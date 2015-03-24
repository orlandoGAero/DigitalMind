<?php ob_start() ?>
<!--Script para el paginado-->
<script type="text/javascript" src="js/paging.js"></script>
<!-- CSS -->
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox-buttons.css">        
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">


	<!-- Grab Google CDN's jQuery, fall back to local if offline -->
 		<script>window.jQuery || document.write('<script src="js/fancybox/libs/jquery-1.7.1.min.js"><\/script>')</script>
        
        
	<!-- FancyBox -->
		<script src="js/fancybox/jquery.fancybox.js"></script>
		
		
        <script type="text/javascript">
			$(document).ready(function() {
			$("#various1").fancybox();
			});

			function cpview(form)
			{
				
  				$('#marca').load('../app/templates/marca/new_marca.php?' + $('#frmdoM').serialize())    
				
			}

			$(function (e) {
				$('#frmdoM').submit(function (e) {
					e.preventDefault()
					$('#marca').load('../app/templates/marca/new_marca.php?' + $('#frmdoM').serialize())
				})
			})
</script>


<link rel="stylesheet" type="text/css" href="css/style-table.css">
	<table class="buscar">
		<tr>
			<td width="100%">
				<form name="formBusqueda" action="index.php?url=buscarMarca" method="POST">
				<b class="azul">Buscar</b> <input type="text" name="busqueda" maxlength="50" required />
				</form>	<td>
				<!--<a href='index.php?url=agregarFam'>-->
				<a id='various1' href="#marca" class="fancybox"><img src="images/add.png" width="25px" height="25px"/></a></td>
				<div id="resultado"></div>
			</td>
		</tr>
	</table>

<br><br>
<?php if (count($crit['resultado'])>0): ?>
	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->
<div class='table-responsive'>
<table class="table" id="miTabla">
<thead>
	
	<th>Clave</th>
	<th>Marca</th>
	<th>Estatus</th>
	<th>Operaciones</th>
</thead>
<?php foreach ($crit['resultado'] as $criterio) : ?>
<tr>
		<?php echo"	<td>".$criterio['id_marca']."</td>";?>
			<td><?php echo $criterio['nombre_marca']?></td>
			<td><?php echo $criterio['activo']?></td>
			<td>
				<a href="index.php?url=verMarca&id_marca=<?php echo $criterio['id_marca'] ?>"><img src="images/detalle.png"/></a>
				<a href="index.php?url=verMarMod&id_marca=<?php echo $criterio['id_marca'] ?>"><img src="images/editar.png"/></a>
				<a href="index.php?url=elimMarca&id_marca=<?php echo $criterio['id_marca'] ?>"><img src="images/eliminar.png"/></a>
			</td>	
</tr>
    <?php endforeach; ?>
</table>
 <?php endif; ?>
</div>

	<script type="text/javascript">
	var pager = new Pager('miTabla', 4);
	pager.init();
	pager.showPageNav('pager', 'NavPosicion');
	pager.showPage(1);
</script>
	

	
<!--  ventana emergente-->
<div style="display: none;">
	<div id="marca" style="width:250px;height:220px;overflow:auto;">
<div class='table-responsive'><!-- Aqui va el contenido de la ventana-->
<h1 align="center">Ingresa la Nueva Marca</h1>
<center>

    	<form action="#" method="POST" name="frmdoM" id="frmdoM" target="_self">            

    		<?php
                 $idM = model::incrementoMarca(['id_marca']);
			?>
            
		  <!--<label>Clave:</label>-->
		  <input type="text"  name="idMarca" value="<?php echo $idM ?>" readonly class="form-control" /><br>
          <!--<label>Nombre:</label>-->
          <input name="nombreM" type="text" class="form-control" required pattern="[a-zA-Z]*" placeholder="Ingresa nombre marca"/><br>
        <!--<label>Activo</label><br>
								Si <input type = 'radio' name = 'activo' value = 'Si' required="required" />
								No <input type = 'radio' name = 'activo' value = 'No' required="required" />-->
		<input type="submit" value="Guardar" onClick="parent.jQuery.fancybox.close();" >				

   		 </form>


</center>
        
	</div>
</div>
<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

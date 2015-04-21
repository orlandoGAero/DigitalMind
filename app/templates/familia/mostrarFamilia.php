<?php ob_start() ?>
<!-- Script de Tiny Table Sorter -->
<script type="text/javascript" src="js/tinyTableSorter.js"></script>

<script>
		function confirmar () {
		  msg = confirm('¿Desea Eliminar o Desactivar?');
		  return msg;
	  	}
</script>

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
				
  				$('#familia').load('../app/templates/familia/new_familia.php?' + $('#frmdoF').serialize())    
				
			}

			$(function (e) {
				$('#frmdoF').submit(function (e) {
					e.preventDefault()
					$('#familia').load('../app/templates/familia/new_familia.php?' + $('#frmdoF').serialize())
				})
			})
</script>

<link rel="stylesheet" type="text/css" href="css/style-table.css">
<div id="busquedad" class="buscar">
	<table class="table-responsive">
		<tr>
			<td width="100%">
			<!--action="index.php?url=buscarFam"-->
				<form name="formBusqueda"  method="POST">
				<b class="azul">Buscar</b> <input type="search" id="buscador" name="busqueda" maxlength="50" required />
				</form>	<td>
				<a id='various1' href="#familia" class="fancybox"><img src="images/add_fam.png" width="25px" height="25px"/></a></td>
				<div id="resultado"></div>
			</td>	

		</tr>
	</table>
</div>
	
	<!--<div id="NavPosicion"></div> Div donde se mostrara las opciones del paginado 1|2|3...-->
	<div id="controls">
			<div id="perpage">
				<select onchange="sorter.size(this.value)">
					<option value="5" selected="selected">5</option>
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				<span>Registros por página</span>
			</div>
			<div id="text">Página <b><span id="currentpage"></span></b> de <b><span id="pagelimit"></span></b></div>
			<div id="navpage">
				<img src="images/first.gif" width="16" height="16" alt="First Page" title="Primer Página" onclick="sorter.move(-1,true)" />
				<img src="images/previous.gif" width="16" height="16" alt="First Page" title="Anterior Página" onclick="sorter.move(-1)" />
				<img src="images/next.gif" width="16" height="16" alt="First Page" title="Siguiente Página" onclick="sorter.move(1)" />
				<img src="images/last.gif" width="16" height="16" alt="Last Page" title="Última Página" onclick="sorter.move(1,true)" />
			</div>
		</div>
		<br/>
<div class='table-responsive'>
<table class="table sortable" id="miTabla">
<caption>FAMILIA</caption>
	<thead>
		
		<th><h5>Clave</h5></th>
		<th><h5>Nombre</h5></th>
		<th><h5>Estatus</h5></th>
		<th colspan="3" class="nosort"><h5>Operaciones</h5></th>
	</thead>
<?php foreach($obtenerFamilias['familia'] as $listaFam):?>
	<tr>
		
			<td><?php echo $listaFam['id_fam']?></td>
			<td><?php echo $listaFam['nombre_fam']?></td>
			<td><?php echo $listaFam['activo']?></td>
			<td><a href="index.php?url=verFam&id_fam=<?php echo $listaFam['id_fam'] ?>"><img src="images/detalle.png"/></a></td>
			<td><a href="index.php?url=verFamMod&id_fam=<?php echo $listaFam['id_fam'] ?>"><img src="images/editar.png"/></a></td>
			<td><a href="index.php?url=eliFam&id_fam=<?php echo $listaFam['id_fam'] ?>" onclick='javascript:return confirmar();'><img src="images/eliminar.png"/></a></td>
			</td>
	</tr>
		<?php endforeach; ?>
</table>
</div>


<!--  ventana emergente-->
<div style="display: none;">
	<div id="familia" style="width:250px;height:220px;overflow:auto;">
<div class='table-responsive'><!-- Aqui va el contenido de la ventana-->
<h1 align="center">Ingresa la Nueva Familia</h1>
<center>

    	<form action="#" method="POST" name="frmdoF" id="frmdoF" target="_self">            

    		<?php
                 $idF = model::incrementoFam(['id_fam']);
			?>
            
		  <!--<label>Clave:</label>-->
		  <input type="text"  name="idFamilia" value="<?php echo $idF ?>" readonly class="form-control" /><br>
          <!--<label>Nombre:</label>-->
          <input type="text" name="nombre_fam" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" placeholder="Ingresa nombre familia"/>
		  <br><!--<label>Activo</label><br>
								Si <input type = 'radio' name = 'activo' value = 'Si' required="required" />
								No <input type = 'radio' name = 'activo' value = 'No' required="required" />-->
		<input type="submit" value="Guardar" onClick="parent.jQuery.fancybox.close();" class="boton2">				
   		 </form>
   		</center>
       </div>
     </div>


	
	<!-- Función JQuery para filtrar familia -->
	<script type="text/javascript">
		jQuery("#buscador").keyup(function(){
		    if( jQuery(this).val() != ""){
		        jQuery("#miTabla tbody>tr").hide();
		        jQuery("#miTabla td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
		        $('#NavPosicion').hide();
		    }
		    else{
		    jQuery("#miTabla  tbody>tr").show();
		        $('#NavPosicion').show();
		        var pager = new Pager('miTabla', 5);
				pager.init();
				pager.showPageNav('pager', 'NavPosicion');
				pager.showPage(1);
		    }
		});
		 
		jQuery.extend(jQuery.expr[":"], 
		{
		    "contiene-palabra": function(elem, i, match, array) {
		        return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		    }
		});
	</script>


<!-- Script para ordenar columnas, paginado y mostrar cierta cantidad de registros TINY Table Sorter -->
<script type="text/javascript">
	 var sorter = new TINY.table.sorter("sorter");
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		// sorter.evensel = "evenselected";
		// sorter.oddsel = "oddselected";
		sorter.pagesize = 5;
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("miTabla",1);
  	</script>

<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

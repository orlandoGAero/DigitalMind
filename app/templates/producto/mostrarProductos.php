<?php ob_start() ?>
<!-- Script de Tiny Table Sorter -->
<script type="text/javascript" src="js/tinyTableSorter.js"></script>

<script>
		function confirmar () {
		  msg = confirm('¿Desea Eliminar o Desactivar?');
		  return msg;
	  	}
</script>

<link rel="stylesheet" type="text/css" href="css/style-table.css">
<div id="busquedad" class="buscar">
	<table class="table-responsive">
		<tr>
			<td width="100%">
				<form name="formBusqueda" action="" method="POST">
				<b class="azul">Buscar</b> <input type="search" id="buscador" name="busqueda" maxlength="50" required />
				</form>	<td>
				<a href="index.php?url=agregarProd"><img src="images/addP.png" width="30px" height="30px"/></a></td>
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
<caption>PRODUCTOS</caption>
	<thead>	
		<th><h5>PRODUCTO</h5></th>
		<th><h5>MODELO</h5></th>
		<th><h5>DESCRIPCION</h5></th>
		<th><h5>MARCA</h5></th>
		<th><h5>FAMILIA</h5></th>
		<th><h5>LINEA</h5></th>
		<th><h5>EXISTENCIA</h5></th>
		<th colspan="3" class="nosort"><h5>Operaciones</h5></th>
	</thead>
<?php foreach($obtenerProductos['productos'] as $listaProd):?>
	<tr>
		
			<td><?php echo $listaProd['nombre_producto']?></td>
			<td><?php echo $listaProd['modelo']?></td>
			<td><?php echo $listaProd['descripcion']?></td>
			<td><?php echo $listaProd['nombre_marca']?></td>
			<td><?php echo $listaProd['nombre_fam']?></td>
			<td><?php echo $listaProd['nombre_linea']?></td>
			<td><?php echo $listaProd['existencia']?></td>
			<td><a href="index.php?url=verProducto&id_producto=<?php echo $listaProd['id_producto'] ?>"><img src="images/detalle.png"/></a></td>
			<td><a href="index.php?url=verProdMod&id_producto=<?php echo $listaProd['id_producto'] ?>"><img src="images/editar.png"/></a></td>
			<td><a href="index.php?url=eliFam&id_producto=<?php echo $listaProd['id_producto'] ?>" onclick='javascript:return confirmar();'><img src="images/eliminar.png"/></a></td>
			</td>
	</tr>
		<?php endforeach; ?>
</table>
</div>


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


	
	<!-- Función JQuery para filtrar prod -->
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





<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

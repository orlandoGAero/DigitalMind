 <?php 
 	/**
	 * ob_start() envia todos los resultados del script desde la invocación de la función a un buffer interno. Dichos resultados se recojen a través de la función ob_get_clean().
	 */
?>
<?php ob_start() ?>
	
	<script type="text/javascript" src="js/tinyTableSorter.js"></script>
	
	<div>
		<a href='index.php?url=insertContact'><img src="images/add.png" title="Nuevo Contacto" align='right' width="25px" height="25px"/></a>
	</div>
	
	<div id="busquedad" >
		<form name="formBusqueda">
			<ul>
				<li><b class="azul">Buscar por:</b></li>
				<li>
					<label>Nombre Completo</label>
					<input type="search" name="busqueda" autocomplete="off" maxlength="50" required="required"  placeholder="Ingresa el nombre" />
					<label>Área</label>
					<select name="filtroArea">
						<option value="0" >Selecciona el área</option>
						<option></option>
					</select>
				</li>
			</ul>
		</form>			
	</div>
	
	<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
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
	
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para incluir los estilos a la tabla -->
    	<table class="table sortable" id="miTabla">
    		<caption>Contactos</caption>
			<thead>
				<tr>
					<th><h5>Nombre</h5></th>
					<th><h5>Apellido Paterno</h5></th>
					<th><h5>Apellido Materno</h5></th>
					<th><h5>Área</h5></th>
					<th><h5>Móvill</h5></th>
					<th><h5>Télefono Oficina</h5></th>
					<th><h5>Correo Personal</h5></th>
					<th><h5>Activo</h5></th>
					<th class="nosort" ><h5>Operaciones</h5></th>
				</tr>
			</thead>			
			
			<?php 
				foreach ($obtenerDatosContactos['contactos'] as $contact) :
				$idContacto = $contact['id_contacto'];
				// Encriptamos el texto
				//$c = Encrypter::encrypt("$idContacto");
			?>
				<tr>
					<td><?php echo $contact['nombreCon'] ?></td>
					<td><?php echo $contact['ap_paterno'] ?></td>
					<td><?php echo $contact['ap_materno'] ?></td>
					<td><?php echo $contact['nombre_area'] ?></td>
					<td><?php echo $contact['movil'] ?></td>
					<td><?php echo $contact['tel_oficina'] ?></td>
					<td><?php echo $contact['correo_p'] ?></td>
					<td><?php echo $contact['activo'] ?></td>
					<td>
						<?php echo "<a href='index.php?url=viewContact&idContact=".$idContacto."'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
						<?php echo "<a href='index.php?url=updateContact&idContact=".$idContacto."'>" ?> <img src="images/editar.png" title="Modificar"/></a>
						<?php echo "<a href='index.php?url=deletedContact&idContact=".$idContacto."'>" ?> <img src="images/eliminar.png" title="Eliminar"/></a>
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
		sorter.pagesize = 10;
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("miTabla",1);
  	</script>
		
	<!-- Función JQuery para filtrar los datos de la tabla de contactos -->
	<!-- <script type="text/javascript">
	
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
		
	</script> -->
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
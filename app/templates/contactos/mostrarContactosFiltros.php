<?php if($obtenerDatosContactos['contactos'] != NULL) :?>
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
	<br />
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		<a href="index.php?url=listContact"><img src="images/table_refresh.png" title="Tabla principal" align='left' width="25px" height="25px" /></a>
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para incluir los estilos a la tabla -->
		<table class="table sortable" id="miTabla">
			<caption>Contactos</caption>
			<thead>
				<tr>
					<th><h5>Nombre</h5></th>
					<th><h5>Apellido Paterno</h5></th>
					<th><h5>Apellido Materno</h5></th>
					<th><h5>Municipio</h5></th>
					<th><h5>Colonia</h5></th>
					<th><h5>Área</h5></th>
					<th><h5>Télefono Móvill</h5></th>
					<th class="nosort"><h5><img src="images/whatsapp.png" title="WhatsApp"/></h5></th>
					<th><h5>Correo Personal</h5></th>
					<!-- <th><h5>Activo</h5></th> -->
					<th class="nosort"><h5>Operaciones</h5></th>
				</tr>
			</thead>			
			
			<?php 
				foreach ($obtenerDatosContactos['contactos'] as $contact) :
				$idContacto = $contact['id_contacto'];
			?>
				<tr>
					<td><?php echo $contact['nombreCon'] ?></td>
					<td><?php echo $contact['ap_paterno'] ?></td>
					<td><?php echo $contact['ap_materno'] ?></td>
					<td>
						<?php $contact['municipio'] = mb_strtoupper($contact['municipio']); ?>
						<?php echo $contact['municipio'] ?>
					</td>
					<td><?php echo $contact['colonia'] ?></td>
					<td><?php echo $contact['nombre_area'] ?></td>
					<td><?php echo $contact['movil'] ?></td>
					<?php if($contact['whatsapp'] == "Si") :?>
						<td><img src="images/ok.png" width="25px" height="25px" title="Si" /></td>
					<?php else :?>
						<td><img src="images/not.png" width="23px" height="23px" title="No" /></td>
					<?php endif ?>
					<td><?php echo $contact['correo_p'] ?></td>
					<!-- <td><?php echo $contact['activo'] ?></td> -->
					<td>
						<?php echo "<a href='index.php?url=viewContact&idContact=".$idContacto."'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
						<?php echo "<a href='index.php?url=updateContact&idContact=".$idContacto."'>" ?> <img src="images/editar.png" title="Modificar"/></a>
						<?php echo "<a href='index.php?url=deletedContact&idContact=".$idContacto."'  onclick='javascript:return asegurar();' >" ?> <img src="images/eliminar.png" title="Eliminar"/></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php else :?>
	<br />
	<pre>
		<a href="index.php?url=listContact"><img src="images/leftarrow.png" title="Regresar" align='left' width="30px" height="30px" /></a>
		<h3 class="azul">Sin resultados</h3>
	</pre>
<?php endif ?>

<!-- Script para ordenar columnas, paginado y mostrar cierta cantidad de registros TINY Table Sorter -->
<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.pagesize = 10;
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("miTabla",0);
</script>
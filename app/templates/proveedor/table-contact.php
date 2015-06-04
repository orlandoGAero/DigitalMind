
<div id="datos_contact">
	<?php if ($obtContactos['listcontacto'] !=NULL) :?>	
		<div class="table-responsive">
			<!-- "id" para incluir los estilos a la tabla -->
			<table class="table" id="miTabla">
				<caption>Contactos</caption>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>&Aacute;rea</th>
						<th>M&oacute;vil</th>
						<th>Elegir</th>
					</tr>
				</thead>

				<?php
					foreach ($obtContactos['listcontacto'] as $contacto) :
					$idContact = $contacto['id_contacto'];

				?>
						<tr>
							<td>
								<?php 
								  echo $contacto['nombreCon']." "
									  .$contacto['ap_paterno']." "
									  .$contacto['ap_materno'] 
								?>
							</td>
							<td><?php echo $contacto['nombre_area'] ?></td>
							<td><?php echo $contacto['movil'] ?></td>
							<td>
								<form action= '' method='POST' enctype='application/x-www-form-urlencoded' name='frmaddC' target='_self'>
									<input type='text' name='txt_idproveedor' id="txt_idproveedor" readonly value='<?php echo $claveProvee ?>'/> 
									<input type='text' name='txt_idCon' id="txt_idCon" readonly value='<?php echo $idContact ?>'/> 
									<!-- botón de tabla contactos -->
									<input type='button' class='boton2 agregarCont' name='btnAddContacto' value='Agregar'/>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
			</table>
		</div>
	<?php endif; ?>
</div> <!--fin de div datos_contact-->
				
		
		

<script type="text/javascript">
	 $(function () {
        $('.agregarCont').click(function () {
                formdc = this.form;
                $('#datos_contact').load('index.php?url=InsertarContacto&',$(formdc).serialize());
            });
    });  
</script>
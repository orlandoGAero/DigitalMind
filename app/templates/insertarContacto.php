<?php ob_start() ?>

<div class="" >
	<a href="index.php?url=listContact">Cerrar</a>
</div>

<?php if (isset($parametrosContactos['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $parametrosContactos['mensaje'] ?></span></b>
<?php endif; ?>
	 <br/>
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
	</script>
	
	<h1><!-- <a href="index.php?url=listContact" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" width="20px" height="20px" /></a> -->Nuevo Contacto</h1>
	<div class="menu-pro">
		<ul>
			<form action="index.php?url=insertContact" method="POST" name="formContact">
				<li><a href="#">Datos Contacto</a>
					<ul>
						<li>
							<table  class="table" >
								<tr> <!-- IdContacto --> <td> <input type="text" name="idContact" required value="<?php echo $parametrosContactos['idCont'] ?>" /> </td>  </tr>
								<tr> <th> Nombre </th> <td> <input type="text" name="nameContact" required value="<?php echo $parametrosContactos['nombre'] ?>" /> * </td>  </tr>
								<tr> <th> Apellido Paterno </th> <td> <input type="text" name="ApPContact" required value="<?php echo $parametrosContactos['app'] ?>"  /> * </td>  </tr>
								<tr> <th> Apellido Materno </th> <td> <input type="text" name="ApMContact" required value="<?php echo $parametrosContactos['apm'] ?>" /> * </td>  </tr>
								<tr> <th> Área </th> <td> <input type="text" name="nameArea" required value="<?php echo $parametrosContactos['area'] ?>" /> * </td>  </tr>
								<tr> <th> Teléfono Móvil </th> <td> <input type="text" name="telMovil" required value="<?php echo $parametrosContactos['movil'] ?>" /> * </td>  </tr>
								<tr> <th> Teléfono Oficina </th> <td> <input type="text" name="telOficina" required value="<?php echo $parametrosContactos['tel_ofi'] ?>" /> * </td>  </tr>
								<tr> <th> Teléfono Emergencia </th> <td> <input type="text" name="telEmergencia" required value="<?php echo $parametrosContactos['tel_emer'] ?>" /> * </td>  </tr>
								<tr> <th> Correo Personal </th> <td> <input type="text" name="emailPersonal" required value="<?php echo $parametrosContactos['correoPers'] ?>" /> * </td>  </tr>
								<tr> <th> Correo Institucional </th> <td> <input type="text" name="emailInstitucional" required value="<?php echo $parametrosContactos['correoInsti'] ?>" /> * </td>  </tr>
								<tr> <th> Facebook </th> <td> <input type="text" name="redSocialF"  value="<?php echo $parametrosContactos['RSFacebook'] ?>" /> </td>  </tr>
								<tr> <th> Twitter </th> <td> <input type="text" name="redSocialT" value="<?php echo $parametrosContactos['RSTwitter'] ?>" /> </td> </tr>
								<tr> <th> Skype </th> <td> <input type="text" name="redSocialS"  value="<?php echo $parametrosContactos['RSSkype'] ?>" /> </td> </tr>
								<tr> <th> Página web </th> <td> <input type="text" name="webPage"  value="<?php echo $parametrosContactos['pagWeb'] ?>" /> </td> </tr>
							</table>
						</li>
					</ul>
				</li>
				<li><a href="#" >Datos Dirección Física</a>
					<ul>
						<li>
							<table class="table">
								<tr class="direccion">
									<th></th>
									<td>
										<table>
											<tr>
												<td width="220px"></td>
												<td width="210px"></td>
												<td width="210px"><a href=""><img src="images/new_dir.png" alt="Nueva Dirección" title="Nueva Dirección" /> Nueva</a></td>
												<td width="225px"><a href=""><img src="images/buscar.png" alt="Agregar Dirección" title="Agregar Dirección" /> Agregar</a></td>
											</tr>
										</table>
									</td>
								</tr>
									<?php  //$id_dir = model::incrementoDir(['id_direccion']);	?>
									<tr><th>Clave</th><td><input type="text"  name="id_direccion" value="<?php //echo $id_dir  ?>" readonly /></td></tr>
									<tr><th>Código P.</th><td><input type="text" id="cp" name="cp"/></td></tr>
									<tr><th>Municipio</th><td><input type="text" id="muni" name="muni"/></td></tr>
									<tr><th>Localidad</th><td><input type="text" id="localidad" name="localidad"/></td></tr>
									<tr><th>Estado</th><td><input type="text" id="estado" name="estado"/></td></tr>
									<tr><th>Calle</th><td><input type="text" id="Calle" name="Calle" /></td></tr>
									<tr><th>No. Ext</th><td><input type="text" id="Num_Ext" name="Num_Ext" readonly /></td></tr>
									<tr><th>No. Int</th><td><input type="text" id="Num_Int" name="Num_Int" readonly /></td></tr>
									<tr><th>Colonia</th><td><input type="text" id="Colonia" name="Colonia" readonly /></td></tr>
									<tr><th>Referencia</th><td><input type="text" id="Referencia" name="Referencia" readonly /></td></tr>
									<tr><th>GPS Ubicación</th><td><input type="text" id="GPS_Ubicacion" name="GPS_Ubicacion" readonly /></td></tr>
							</table>
						</li>
					</ul>
				</li>
				
				<input type="submit" class="" value="Guardar" name="btnGuardar" />
				
			</form>
		</ul>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
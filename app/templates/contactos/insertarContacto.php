<?php ob_start() ?>

<?php if (isset($parametrosContactos['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $parametrosContactos['mensaje'] ?></span></b>
<?php endif; ?>
	 <br/>
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	 	
	<div class="col-lg-14">
        <div class="panel panel-default">
			<h1><a href="index.php?url=listContact" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" width="20px" height="20px" /></a>Nuevo Contacto</h1>
				<div class="panel-heading">    </div>
			    <div class="panel-body">	
					<section id="principal">
						<div class="menu-pro">
							<ul>
								<form action="index.php?url=insertContact" method="POST" id="formContact" target="_self" >
									<li><a href="#">Datos Contacto</a>
										<ul>
											<li>
												<table  class="nuevo-pro" >
													<tr> <!-- IdContacto --> <td><input type="hidden" name="idContact" value="<?php echo $parametrosContactos['idCont']  ?>" readonly /> </td>  </tr>
													<tr> <th> Nombre </th> <td> <input type="text" name="nameContact" autofocus="autofocus" autocomplete="off"   maxlength="50" value="<?php echo $parametrosContactos['nombre'] ?>" /> * </td>  </tr>
													<tr> <th> Apellido Paterno </th> <td> <input type="text" name="ApPContact" autocomplete="off" maxlength="50" value="<?php echo $parametrosContactos['app'] ?>"  /> * </td>  </tr>
													<tr> <th> Apellido Materno </th> <td> <input type="text" name="ApMContact" autocomplete="off"  maxlength="50" value="<?php echo $parametrosContactos['apm'] ?>" /> * </td>  </tr>
													<tr> <th> Área </th> <td> <input type="text" name="nameArea" autocomplete="off" required="required" maxlength="50" value="<?php echo $parametrosContactos['area'] ?>" /> * </td>  </tr>
													<tr> <th> Teléfono Móvil </th> <td> <input type="text" id="tel" class="keysNumbers" name="telMovil" autocomplete="off" required="required" maxlength="10" value="<?php echo $parametrosContactos['movil'] ?>" /> * </td>  </tr>
													<tr> <th> Teléfono Oficina </th> <td> <input type="text" id="tel" class="keysNumbers" name="telOficina" autocomplete="off" required="required" maxlength="10" value="<?php echo $parametrosContactos['tel_ofi'] ?>" /> * </td>  </tr>
													<tr> <th> Teléfono Emergencia </th> <td> <input type="text" id="tel" class="keysNumbers" name="telEmergencia" autocomplete="off" required="required" maxlength="10" value="<?php echo $parametrosContactos['tel_emer'] ?>" /> * </td>  </tr>
													<tr> <th> Correo Personal </th> <td> <input type="email" name="emailPersonal" autocomplete="off" required="required" maxlength="50" placeholder="nombre@ejemplo.com" value="<?php echo $parametrosContactos['correoPers'] ?>" /> * </td>  </tr>
													<tr> <th> Correo Institucional </th> <td> <input type="email" name="emailInstitucional" autocomplete="off" maxlength="50" placeholder="nombre@ejemplo.com" value="<?php echo $parametrosContactos['correoInsti'] ?>" /> </td>  </tr>
													<tr> <th> Facebook </th> <td> <input type="text" name="redSocialF"  autocomplete="off" maxlength="20" value="<?php echo $parametrosContactos['RSFacebook'] ?>" /> </td>  </tr>
													<tr> <th> Twitter </th> <td> <input type="text" name="redSocialT" autocomplete="off" maxlength="20" value="<?php echo $parametrosContactos['RSTwitter'] ?>" /> </td> </tr>
													<tr> <th> Skype </th> <td> <input type="text" name="redSocialS"  autocomplete="off" maxlength="20" value="<?php echo $parametrosContactos['RSSkype'] ?>" /> </td> </tr>
													<tr> <th> Página web </th> <td> <input type="url" name="webPage"  autocomplete="off" maxlength="30" placeholder="http://www.ejemplo.com" value="<?php echo $parametrosContactos['pagWeb'] ?>" /> </td> </tr>
												</table>
											</li>
										</ul>
									</li>
									<li><a href="#" >Datos Dirección Física</a>
										<ul>
											<li>
												<table class="nuevo-pro" >
													<tr class="direccion">
														<th></th>
														<td>
															<table>
																<tr>
																	<td width="220px"></td>
																	<td width="210px"></td>
																	<!--<td width="210px"><a href=""><img src="images/new_dir.png" alt="Nueva Dirección" title="Nueva Dirección" /> Nueva</a></td>-->
																	<td width="225px"><a href=""><img src="images/buscar.png" alt="Agregar Dirección" title="Agregar Dirección" /> Agregar</a></td>
																</tr>
															</table>
														</td>
													</tr>
														<tr><!-- IdDirección --><td><input type="hidden"  name="idAddress" value="<?php echo $parametrosContactos['idDir'] ?>" readonly /></td></tr>
														<tr>
															<th>Código Postal</th>
															<td><input type="text" class="keysNumbers" name="postcode" autocomplete="off" required="required"  maxlength="5"  value="<?php echo $parametrosContactos['cp'] ?>"    onKeyUp="cpview(this.form)" /></td>
														</tr>
														
														<?php if($parametrosContactos['cp'] != "") :?>
															<tr><td colspan="2">
																<div id="resultado"> 
																	<table class="table" id="miTabla">
																		<tr>
																			<th>Estado</th>
																			<th>Municipio</th>
																			<th>Localidad</th>
																		</tr>
																		
																		<tr>
																			<td><?php echo $obtenerDatosDir['estado'] ?> <input type="text" name="state" readonly="readonly" value="<?php echo $obtenerDatosDir['estado'] ?>" </td>
																			<td><?php echo $obtenerDatosDir['municipio'] ?>  <input type="text" name="municipality" readonly="readonly" value="<?php echo $obtenerDatosDir['municipio'] ?>" </td>
																			<td>
																				<select id="loc" name="idcp-locality" >
																					<option value="<?php echo $obtenerDatosDir['idCP'] ?>"><?php echo $obtenerDatosDir['localidad'] ?></option>
																					<?php foreach ($obtenerDatosDir['codigoP'] as $locality) : ?>
																							<option required='required' value="<?php echo $locality['id_cp'] ?>"> <?php echo $locality['localidad'] ?> </option> ?>
																					<?php endforeach; ?>
																				</select>
																			</td>
																		</tr> 
																	</table>
																</div>
															</td></tr>
														<?php else :?>
															<tr><td colspan="2"><div id="resultado"> </div></td></tr>
														<?php endif; ?>
														
														<tr><th>Calle</th><td><input type="text" name="street" autocomplete="off" required="required" maxlength="50" value="<?php echo $parametrosContactos['calleD'] ?>" /> * </td></tr>
														<tr><th>No. Ext</th><td><input type="text" class="keysNumbers" name="numExt" autocomplete="off" required="required" maxlength="5" value="<?php echo $parametrosContactos['numExterior'] ?>" /> * </td></tr>
														<tr><th>No. Int</th><td><input type="text" class="keysNumbers" name="numInt" autocomplete="off" maxlength="5" value="<?php echo $parametrosContactos['numInterior'] ?>" /></td></tr>
														<tr><th>Colonia</th><td><input type="text" name="colonia" autocomplete="off" required="required" maxlength="50" value="<?php echo $parametrosContactos['coloniaD'] ?>" /> * </td></tr>
														<tr><th>Referencia</th><td><input type="text" name="reference" autocomplete="off" value="<?php echo $parametrosContactos['referenciaD'] ?>" /></td></tr>
												</table>
											</li>
										</ul>
									</li>
									
									<input type="submit" class="boton2" value="Guardar" name="btnGuardar" id="btnGuardar"/>
									
								</form>
							</ul>
						</div>
					</section>
				</div>
			</div>
	</div>
	
	<script type="text/javascript">
		
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
		
		function cpview(form)
		{
	       $('#resultado').load('index.php?url=obtenerDir&postcode=' + $('#formContact').serialize())    
		}
		
		jQuery(document).ready(function() {
		    jQuery('.keysNumbers').keypress(function(tecla) {
		        if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		    });
		});
	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
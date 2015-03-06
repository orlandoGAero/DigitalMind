<?php ob_start() ?>

	<?php 
		$obtenerDatosProv['id_prov'];

		if (isset($parametrosProveedores['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $parametrosProveedores['mensaje'] ?></span></b>
	<?php endif; ?>
	 <br/>
	<!DOCTYPE html>
	<html>
		<head>
		    <!-- JS Formulario Listas Desplegables -->
			<!-- modificar linea de abajo-->
			<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
			<script>
				$('document').ready(function(){
					$('.menu-pro').lksMenu();
				});
			</script>
			<script>
				function cpview(form)
				{
			       $('#resultado').load('index.php?url=obtenerDir&postcode=' + $('#formprov').serialize())    
				}
			</script>
		</head>
		<body>
			<div class="col-lg-14">
				<!-- div de imagen -->
				<div align="left"><a href="index.php?url=Proveedores" onclick="return confirm('¿Desea salir antes de actualizar?');"><img src="images/leftarrow.png" title="Regresar"></a></div>

				<div class="panel panel-default">	
					<h1>Editar Proveedor</h1>
					<div class="panel-heading" style="height:40px;">
						<span class="span">&nbsp;* Información requerida</span>
    				</div>
					<div class="panel-body">
						<section id="principal">
							<div class="menu-pro">
								<ul>
									<?php echo "<form action='index.php?url=EditarProveedores&id_Proveedor=".$obtenerDatosProv['id_prov']."' method='POST' name='formprov' id='formprov' target='_self'>"; ?>
										
										<li><a href="#"><b>Datos Proveedor</b></a>
											<ul>
												<li>	
													<li>
														<input type="hidden" name="txt_idProv" value="<?php echo $obtenerDatosProv['idprov'] ?>" readonly/>
													</li>

													<ul>
														<li>
															<label for="lbl_proveedor">Proveedor:</label>
															<input type="text" name="txt_nombrepro" value="<?php echo $obtenerDatosProv['proveedor'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
													
														<li>
															<label for="lbl_categoria">Categor&iacute;a:</label>
															<select id="catprov" name="slt_catprov" required>
																<?php if($obtenerDatosProv['categoria'] != "") :?>
																	<option value="<?php echo $obtenerDatosProv['id_categoria'] ?>"><?php echo $obtenerDatosProv['categoria'] ?></option>
																<?php else :?>
																<option value value="0">Ingresa una categor&iacute;a...</option>
																<?php endif; ?>
																<?php foreach ($obtenerDatosProv['categoria'] as $catpro) : ?>
																<option value="<?php echo $catpro['id_categoria'] ?>"><?php echo $catpro['categoria']?></option>
																<?php endforeach; ?>
															</select>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_tele">Tel&eacute;fono:</label>
															<input type="tel" name="txt_tel_pro" maxlength="10" value="<?php echo $obtenerDatosProv['tel'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_dir">Direcci&oacute;n Web:</label>
															<input type="url" name="txt_url_web" placeholder="http://dominio.com.mx" value="<?php echo $obtenerDatosProv['dirweb'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
													</ul>
												</li>
											</ul>
										</li>

										<li><a href="#"><b>Datos Fiscales</b></a>
											<ul>
												<li>	
													<ul>
														<!-- clave razon social -->
														<input type="hidden"  name="txt_iddf" value="<?php echo $obtenerDatosProv['id_datFiscal'] ?>" readonly />
														<li>
															<label for="lbl_razon">Raz&oacute;n Social:</label>
															<input type="text" name="txt_razon_s" value="<?php echo $obtenerDatosProv['razon_social'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_rfc">RFC:</label>
															<input type="text" name="txt_rfc" value="<?php echo $obtenerDatosProv['rfc'] ?>"required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_tipo">Tipo Raz&oacute;n:</label></td>
															<select id="tipo_rs" name="slt_tipo_rs" required>
																	<option value="0">Ingresa un tipo de raz&oacute;n...</option>
																	<?php foreach($obtenerDatosProv ['tipo'] as $tipors) : ?>
																	<option value="<?php echo $tipors['id_tipo_ra'] ?>"><?php echo $tipors['tipo'] ?></option>
																	<?php endforeach; ?>
															</select>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
													</ul>
												</li>
											</ul>
										</li>

										<li><a href="#"><b>Datos Direcci&oacute;n F&iacute;sica</b></a>
											<ul>
												<li>	
													<ul>
														<!-- clave razon social -->
														<input type="hidden"  name="txt_iddir" value="<?php echo $obtenerDatosProv['id_direccion'] ?>" readonly />
														<li>
															<label for="lbl_">C&oacute;digo Postal:</label>
															<input type="text" class="keysNumbers" name="postcode" autocomplete="off" required  maxlength="5"  pattern="[0-9]{4,5}" value="<?php echo $obtenerDatosProv['codigoP'] ?>" onKeyUp="cpview(this.form)" />
															<span style="color: red;"><b>&nbsp;*</b></span>
															<?php if($obtenerDatosProv['codigoP'] == "") :?>
															<li><div id="resultado"> </div></li>
															<?php else :?>
															<li>
																<div id="resultado"> 
																	<table class="table" id="miTabla">
																		<tr>
																			<th>Estado</th>
																			<th>Municipio</th>
																			<th>Localidad</th>
																		</tr>
																		<tr>
																			<td><?php echo $obtenerDatosProv['estado'] ?> <input type="hidden" name="state" readonly="readonly" value="<?php echo $obtenerDatosProv['estado'] ?>" </td>
																			<td><?php echo $obtenerDatosProv['municipio'] ?>  <input type="hidden" name="municipality" readonly="readonly" value="<?php echo $obtenerDatosProv['municipio'] ?>" </td>
																			<td>
																				<select name="idcp-locality" >
																					<?php if($obtenerDatosProv['localidad'] != "") :?>
																						<option value="<?php echo $obtenerDatosProv['id_cp'] ?>"><?php echo $obtenerDatosProv['localidad'] ?></option>
																					<?php else :?>
																						<option value='0'>Seleccione una Opción</option>
																					<?php endif; ?>
																					<?php foreach ($obtenerDatosDir['codigoP'] as $locality) : ?>
																							<option required='required' value="<?php echo $locality['id_cp'] ?>"> <?php echo $locality['localidad'] ?> </option> ?>
																					<?php endforeach; ?>
																				</select>
																			</td>
																		</tr> 
																	</table>
																</div>
															</li>
															<?php endif; ?>
														</li>

														<li>
															<label for="lbl_calle">Calle:</label>
															<input type="text" name="txt_calle" value="<?php echo $obtenerDatosProv['calle'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_noext">No. Ext:</label>
															<input type="text" name="txt_noext" value="<?php echo $obtenerDatosProv['num_ext'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_noint">No. Int:</label>
															<input type="text" name="txt_noint" value="<?php echo $obtenerDatosProv['num_int'] ?>"/>
														</li>

														<li>
															<label for="lbl_col">Colonia:</label>
															<input type="text" name="txt_col" value="<?php echo $obtenerDatosProv['colonia'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_ref">Referencia:</label>
															<input type="text" name="txt_ref" value="<?php echo $obtenerDatosProv['referencia'] ?>"/>	
														</li>
													</ul>
												</li>
											</ul>
										</li>

										<li><a href="#">Datos Contacto</a>
											<ul>
												<li>	
													<div class="dform">
														<div align="left">
															<table><tr>
																		<td><a href=""><img alt="Nuevo Contacto" title="Nuevo Contacto" src="images/new-contacto.png"></a></td>
																		<td><a href=""><img alt="Selecionar Contacto" title="Seleccionar Contacto" src="images/select-contacto.png"></a></td>
																   </tr>
															</table>
															<div> <!-- div para seleccionar contacto-->
																															
																<div id="SignupForm"> <!-- div SignupForm -->
																	<!-- paso numero 1 -->
																	<fieldset>
																		<legend>Seleccionar Contacto</legend>
																			<div id="tablaCont"></div>
																	</fieldset>
																	<!-- paso numero 2 -->
																	<fieldset>
																		<legend>Contacto Seleccionado</legend>
																			<div id='accion'>
																				
																			</div>
																	</fieldset>
																</div>	<!-- </div> fin div SignupForm -->
															</div> <!--fin de div para seleccionar contactos-->
														</div>
													</div>
												</li>
											</ul>
										</li>

										<li><a href="#"><b>Datos Bancarios</b></a>
											<ul>
												<li>
													<ul>
														<!-- clave datos bancarios -->
															<input type="hidden"  name="txt_iddb" value="<?php echo $obtenerDatosProv['id_datBank'] ?>" readonly />
														<li>
															<label for="lbl_banco">Banco:</label>
															<select id="banco" name="slt_banco" required>
																<option value selected>Selecciona un banco...</option>
																<?php foreach($obtenerDatosProv ['nombre_banco'] as $bank) : ?>
																<option value="<?php echo $bank['id_banco'] ?>"><?php echo $bank['nombre_banco'] ?></option>
																<?php endforeach; ?>
															</select>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
															
														<li>
															<label for="lbl_sucursal">Sucursal:</label>
															<input type="text" name="txt_suc" id="" value="<?php echo $obtenerDatosProv['sucursal'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_titular">Titular:</label>
															<input type="text" name="txt_titul" value="<?php echo $obtenerDatosProv['titular'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_cuenta">No. Cuenta:</label>
															<input type="text" name="txt_cuenta" value="<?php echo $obtenerDatosProv['no_cuenta'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_clabe">Clabe Interbancaria:</label>
															<input type="text" name="txt_clabe" maxlength="18" value="<?php echo $obtenerDatosProv['no_cuenta_interbancario'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_tipo_cuenta">Tipo de cuenta:</label>
															<select id="tipo_c" name="slt_tipo_c" required>
																<option value selected>Selecciona un tipo de cuenta...</option>
																<?php foreach ($obtenerDatosProv ['tipo_cuenta'] as $tipo_c) : ?>
																<option value="<?php echo $tipo_c['id_tipo_cuenta'] ?>"><?php echo $tipo_c['tipo_cuenta'] ?></option>
																<?php endforeach; ?>
															</select>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
													</ul>
												</li>
											</ul>
										</li>
											<!-- Botones -->
											<input type="submit" class="boton2" value="Actualizar" name="btnActualizar" id="btnActualizar"/>
											&nbsp;&nbsp;
											<a href="index.php?url=Proveedores" title="Regresar" onclick="return confirm('¿Desea salir antes de actualizar?');">
												<input type="button" class="boton2" value="Cancelar" />
											</a>
									</form>
								</ul>
							</div> <!-- fin de div menu-pro -->
						</section> <!-- fin de seccion principal -->
					</div> <!-- fin de div panel-body -->
				</div> <!-- fin de div panel-default -->
			</div> <!-- fin de div col-lg-14 -->
		</body>
	</html>
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
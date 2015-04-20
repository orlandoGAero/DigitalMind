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
			<!-- Style CSS valid & invalid-->
 			<link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />	<!-- JS Formulario Listas Desplegables -->
	
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
														<input type="text" name="txt_idProv" value="<?php echo $obtenerDatosProv['id_prov'] ?>" readonly/>
													</li>

													<ul>
														<li>
															<label for="lbl_proveedor">Proveedor:</label>
															<input type="text" name="txt_nombrepro" value="<?php echo $obtenerDatosProv['proveedor'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
													
														<li>
															<label for="lbl_categoria">Categor&iacute;a:</label>
															<select id="catprov" name="slt_catprov">
																<?php if($obtenerDatosProv['categoria'] != "") :?>
																	<option value="<?php echo $obtenerDatosProv['id_categoria'] ?>"><?php echo $obtenerDatosProv['categoria'] ?></option>
																	<?php else :?>
																	<option value="0">Ingresa una categor&iacute;a...</option>
																<?php endif; ?>
																<?php foreach ($obtenerCatPro['categoriaprov'] as $catpro) : ?>
																<option required value="<?php echo $catpro['id_categoria'] ?>"><?php echo $catpro['categoria']?></option>
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
														<input type="text"  name="txt_iddf" value="<?php echo $obtenerDatosProv['id_datFiscal'] ?>" readonly />
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
													</ul>
												</li>
											</ul>
										</li>

										<li><a href="#"><b>Direcci&oacute;n Fiscal</b></a>
											<ul>
												<li>
													<ul>
														<!-- clave direccion fiscal-->
														<input type="text"  name="txt_iddir_fis" value="<?php echo $obtenerDirFiscal['id_direccion'] ?>" readonly />
														
														<li>
															<label for="lbl_estadof">Estado:</label>
															<select name="idEstadof" id="statef" required>
																<?php if ($obtenerDirFiscal['estado'] != "") :?>
																	<option value="<?php echo $obtenerDirFiscal['id_estado'] ?>">
																		<?php echo $obtenerDirFiscal['estado'] ?>
																	</option>
																	<?php /*foreach ($parametrosProveedores['idStateFiscal'] as $estado) :?>
																		<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
																	<?php endforeach;?>
																<?php else :?>
																	<option value="<?php echo $parametrosProveedores['idStateFiscal'] ?>"><?php echo $parametrosProveedores['nameEstadoFiscal'] ?></option>
																	<?php foreach ($parametrosContactos['estadosF'] as $estado) :?>
																		<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
																	<?php endforeach; */?>
																<?php endif; ?>
															</select>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_municipio_f">Municipio:</label>
															<?php if($obtenerDirFiscal['municipio'] != "") :?>	
																<select name="idMunicipiof" id="idMunicipiof" required disabled="disabled" onchange="ValidarMunicipioDirF();">
																
																</select>
															<?php else :?>
																<select name="idMunicipiof" id="idMunicipiof" required disabled="disabled" onchange="ValidarMunicipioDirF();">
																	<option value="<?php echo $obtenerDirFiscal['id_cp'] ?>">
																		<?php echo $obtenerDirFiscal['municipio'] ?>
																	</option>
																	<?php /*foreach($parametrosProveedores['municipiosF'] as $nameMuni) :?>
																		<option value="<?php echo $nameMuni['municipio'] ?>">
																			<?php echo $nameMuni['municipio'] ?>
																		</option>
																	<?php endforeach; */?> 	
																</select>
															<?php endif; ?>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_localidad_f">Localidad:</label>
															<input type="text" name="txt_localidad_f" id="localidadf" value="<?php echo $obtenerDirFiscal['localidad']?>" required disabled="disabled" autocomplete="off" value="<?php echo $parametrosProveedores['nameLocalityFiscal'] ?>" onkeyup="dirtxtViewDirFis(this.form)"/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<!--<li>
															<?php if($parametrosProveedores['nameLocalityFiscal'] == "") :?>
																<div id="divResult"></div>
																<?php else :?>
																<div id="divResult">
																	<?php if($parametrosProveedores['localidadesF'] == NULL) :?>
																		<pre><center><table><tr><td><span class="span">Ingresa una localidad valida</span></td></tr></table></center></pre>
																		<?php else :?>
																		<table class="table" id="miTabla">
																			<tr>
																				<th>Estado</th>
																				<th>Municipio</th>
																				<th>Localidad</th>
																				<th>CP</th>
																				<th>Elegir</th>
																			</tr>

																			<?php foreach($parametrosProveedores['localidadesF'] as $dir) :?>
																				<tr>
																					<td><?php echo $dir['estado'] ?></td>
																					<td><?php echo $dir['municipio'] ?></td>
																					<td><?php echo $dir['localidad'] ?></td>
																					<td><?php echo $dir['codigoP'] ?></td>
																					<?php if($dir['id_cp'] == $parametrosProveedores['cpFiscal']) :?>
																						<td><input type="radio" name="idcp-localityFiscal" checked="checked" value="<?php echo $dir['id_cp'] ?>"/></td>
																						<?php else :?>
																							<td><input type="radio" name="idcp-localityFiscal" value="<?php echo $dir['id_cp'] ?>" /></td>
																					<?php endif; ?>
																				</tr>
																			<?php endforeach; ?>
																		</table>
																	<?php endif; ?>
																</div>
															<?php endif; ?>
														</li> -->

														<li>
															<label for="lbl_calle_f">Calle:</label>
															<input type="text" name="txt_calle_f" id="txt_calle_f" value="<?php echo $obtenerDirFiscal['calle'] ?>" required onChange="conMayusculas(this)"/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_noext_f">No. Ext:</label>
															<input type="text" class="keysNumbers" name="txt_noext_f" id="txt_noext_f" value="<?php echo $obtenerDirFiscal['num_ext'] ?>" required/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_noint_f">No. Int:</label>
															<input type="text" class="keysNumbers" name="txt_noint_f" id="txt_noint_f" value="<?php echo $obtenerDirFiscal['num_int'] ?>" />
														</li>

														<li>
															<label for="lbl_col_f">Colonia:</label>
															<input type="text" name="txt_col_f" id="txt_col_f" value="<?php echo $obtenerDirFiscal['colonia'] ?>" required onChange="conMayusculas(this)"/>
															<span style="color: red;"><b>&nbsp;*</b></span>	
														</li>

														<li>
															<label for="lbl_ref_f">Referencia:</label>
															<input type="text" name="txt_ref_f" id="txt_ref_f" value="<?php echo $obtenerDirFiscal['referencia'] ?>" onChange="conMayusculas(this)"/>	
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
														<input type="text"  name="txt_iddir" value="<?php echo $obtenerDatosProv['id_direccion'] ?>" readonly />
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
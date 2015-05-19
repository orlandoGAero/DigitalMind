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

				// funciones dirección fisica
				$(function () {
				    $('#state').change(function (a) {
				        if ($(this).val() != "") {
				            $('#municipio').removeAttr('disabled');
				            $('#municipio').load('index.php?url=viewMunicipality&state=' + this.options[this.selectedIndex].value );
				            if($('#municipio').val("")){
				            	$('#localidad').attr('disabled','disabled').val("");
				        		$("#result").css("display", "none");
				       		}
				        }
				        else {
				            $('#municipio').attr('disabled','disabled').val("");
				            $('#localidad').attr('disabled','disabled').val("");
				            $("#result").css("display", "none");
				        }
				    });
		
				    if ($('#state option:selected').val() != "") {
				        $('#municipio').removeAttr('disabled');
				        $('#localidad').removeAttr('disabled');
				    }
				});

				function ValidarMunicipio() {
				    if ($('#municipio').val() != "") {
				    	$('#localidad').removeAttr('disabled');
				        if($('#localidad').val("")){
				        	$('#localidad').focus();
				        	$("#result").css("display", "none");
				        }
				    }
				    else {
				        $('#municipio').removeAttr('disabled');
				        $('#localidad').attr('disabled','disabled').val("");
				        $("#result").css("display", "none");
				    }
				}

				function dirtxtView(form){
					if($('#localidad').val() != ""){
						$("#result").css("display", "block");
						$('#result').load('index.php?url=viewDirLocality&idEstado=&municipio=&localidad=' + $('#formprov').serialize())	
					}else{
						$("#result").css("display", "none");
					}
				}

				// funcciones para direccion fiscal
				$(function () {
				    $('#statef').change(function (a) {
				        if ($(this).val() != "") {
				            $('#idMunicipiof').removeAttr('disabled');
				            $('#idMunicipiof').load('index.php?url=verMunicipioFiscal&statef=' + this.options[this.selectedIndex].value );
				            if($('#idMunicipiof').val("")){
				            	$('#localidadf').attr('disabled','disabled').val("");
				        		$("#divResult").css("display", "none");
				       		}
				        }
				        else {
				            $('#idMunicipiof').attr('disabled','disabled').val("");
				            $('#localidadf').attr('disabled','disabled').val("");
				            $("#divResult").css("display", "none");
				        }
				    });
				
				    if ($('#statef option:selected').val() != "") {
				        $('#idMunicipiof').removeAttr('disabled');
				        $('#localidadf').removeAttr('disabled');
				    }
				});

				function ValidarMunicipioDirF() {
				    if ($('#idMunicipiof').val() != "") {
				    	$('#localidadf').removeAttr('disabled');
				        if($('#localidadf').val("")){
				        	$('#localidadf').focus();
				        	$("#divResult").css("display", "none");
				        }
				    }
				    else {
				        $('#idMunicipiof').removeAttr('disabled');
				        $('#localidadf').attr('disabled','disabled').val("");
				        $("#divResult").css("display", "none");
				    }
				}

				function dirtxtViewDirFis(form){
					if($('#localidadf').val() != ""){
						$("#divResult").css("display", "block");
						$('#divResult').load('index.php?url=verLocalidadFiscal&idEstadof=&idMunicipiof=&txt_localidad_f=' + $('#formprov').serialize())	
					}else{
						$("#divResult").css("display", "none");
					}
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
														
														<!-- <?php /*if (isset($obtenerDatosProv['estado'])) :*/?> -->
															<li>
																<label for="lbl_estado">Estado:</label>
																<select name="idEstado" id="state" required>
																	<?php if ($obtenerDatosProv['estado'] != "") :?>
																		<option value="<?php echo $obtenerDatosProv['id_estado'] ?>">
																			<?php echo $obtenerDatosProv['estado'] ?>
																		</option>
																		<?php foreach($obtDatosDir['allestados'] as $estados) :?>
																			<option value="<?php echo $estados['id_estado'] ?>">
																				<?php echo $estados['estado'] ?>
																			</option>
																		<?php endforeach; ?>
																	<?php endif; ?>
																</select>
																<span style="color: red;"><b>&nbsp;*</b></span>
															</li>
														<!-- <?php /*endif; */?> -->

														<li>
															<label for="lbl_municipio">Municipio:</label>
															<?php if($obtenerDatosProv['municipio'] != "") :?>	
																<select name="municipio" id="municipio" required disabled="disabled" onchange="ValidarMunicipio();">
																	<option value="<?php echo $obtenerDatosProv['municipio'] ?>">
																		<?php echo $obtenerDatosProv['municipio'] ?>
																	</option>
																	<?php foreach($obtDatosDir['allmunicipio'] as $municipios) :?>
																		<option value="<?php echo $municipios['municipio'] ?>">
																			<?php echo $municipios['municipio'] ?>
																		</option>
																	<?php endforeach; ?>
																</select>
															<?php endif; ?>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>

														<li>
															<label for="lbl_localidad">Localidad:</label>
															<input type="text" name="localidad" id="localidad" required disabled="disabled" autocomplete="off" value="<?php echo $obtenerDatosProv['localidad'] ?>" onkeyup="dirtxtView(this.form)"/>
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
														<li>
															<?php if($obtenerDatosProv['localidad'] != "") :?>
																<div id="result">
																
																	<table class="table" id="miTabla">
																		<tr>
																			<th>Estado</th>
																			<th>Municipio</th>
																			<th>Localidad</th>
																			<th>CP</th>
																			<th>Elegir</th>
																		</tr>

																		<?php foreach($obtDatosDir['all_localidad'] as $dir) :?>
																			<tr>
																				<td><?php echo $dir['estado'] ?></td>
																				<td><?php echo $dir['municipio'] ?></td>
																				<td><?php echo $dir['localidad'] ?></td>
																				<td><?php echo $dir['codigoP'] ?></td>
																				<td><input type="radio" name="idcp-locality" checked="checked" value="<?php echo $dir['id_cp'] ?>"/></td>
																			</tr>
																		<?php endforeach; ?>
																	</table>
																</div>
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
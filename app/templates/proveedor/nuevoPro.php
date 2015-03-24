<?php ob_start() ?>
	<?php if (isset($parametrosProveedores['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $parametrosProveedores['mensaje'] ?></span></b>
	<?php endif; ?>
	 <br/>
 	 <!--<script type="text/javascript" src="js/jquery-1.4.2.min.js">
		$(function (agregar) {
			$('#frm_dbank').submit(function (agregar) {
				agregar.preventDefault()
				$('#datos_bancarios').load('index.php?url=DatosBancarios ?' + $('#frm_dbank').serialize())
			})
		})
	</script>-->
	
	<!-- JS Formulario Listas Desplegables -->
	<!-- modificar linea de abajo-->
	<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});

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

		function conMayusculas(field) {
	            field.value = field.value.toUpperCase()
		}
	</script>
	<!--<script type="text/javascript">
		$('document').ready(function()
		{
			$('#tablaCont').load('index.php?url=TablaContactos');
		});
	</script>-->
	<script type="text/javascript">
		function abrir (url) {
			window.open('index.php?url=insertContact','contacto','width=800,height=400,top=90,left=100,toolbar=no,location=no,status=no,menubar=no')
		}
	</script>
		
	<div class="col-lg-14">
		<!-- div de imagen -->
		<div align="left"><a href="index.php?url=Proveedores" onclick="return confirm('¿Desea salir antes de guardar?');"><img src="images/leftarrow.png" title="Regresar"></a></div>

		<div class="panel panel-default">	
			<h1>Nuevo Proveedor</h1>
			<div class="panel-heading" style="height:40px;">
				<span class="span">&nbsp;* Información requerida</span>
			</div>
			<div class="panel-body">
				<section id="principal">
					<div class="menu-pro">
						<ul>
							<form action="index.php?url=NuevoProveedor" method="POST" name="formprov" id="formprov" target="_self">
								<li><a href="#"><b>Datos Proveedor</b></a>
									<ul>
										<li>	
											<li>
												<input type="hidden" name="txt_idProv" value="<?php echo $parametrosProveedores['idprov'] ?>" readonly/>
											</li>

											<ul>
												<li>
													<label for="lbl_proveedor">Proveedor:</label>
													<input type="text" name="txt_nombrepro" required  autofocus="autofocus" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onchange="conMayusculas(this)" />
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>
											
												<li>
													<label for="lbl_categoria">Categor&iacute;a:</label>
													<select id="catprov" name="slt_catprov" required>
														<option value selected>Ingresa una categor&iacute;a...</option>
														<?php foreach ($parametrosProveedores['categoriaprov'] as $catpro) : ?>
														<option value="<?php echo $catpro['id_categoria'] ?>"><?php echo $catpro['categoria']?></option>
														<?php endforeach; ?>
													</select>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_tele">Tel&eacute;fono:</label>
													<input type="tel" name="txt_tel_pro" maxlength="10" required pattern="[0-9]{10}"/>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_dir">Direcci&oacute;n Web:</label>
													<input type="url" name="txt_url_web" placeholder="http://dominio.com.mx" required/>
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
												<input type="hidden"  name="txt_iddf" value="<?php echo $parametrosProveedores['idDatFis'] ?>" readonly />
												<li>
													<label for="lbl_razon">Raz&oacute;n Social:</label>
													<input type="text" name="txt_razon_s" required onchange="conMayusculas(this)"/>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_rfc">RFC:</label>
													<input type="text" name="txt_rfc" required/>
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
												<input type="text"  name="txt_iddir_fis" value="<?php echo $parametrosProveedores['idDireFiscal'] ?>" readonly />
												
												<li>
													<label for="lbl_estadof">Estado:</label>
													<select name="idEstadof" id="statef" required>
														<?php if ($parametrosProveedores['nameEstadoFiscal'] == "") :?>
															<option value="">Seleccione estado ...</option>
															<?php foreach ($parametrosProveedores['idStateFiscal'] as $estado) :?>
																<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
															<?php endforeach;?>
														<?php else :?>
															<option value="<?php echo $parametrosProveedores['idStateFiscal'] ?>"><?php echo $parametrosProveedores['nameEstadoFiscal'] ?></option>
															<?php foreach ($parametrosContactos['estadosF'] as $estado) :?>
																<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_municipio_f">Municipio:</label>
													<?php if($parametrosProveedores['nameMunicipioFiscal'] == "") :?>	
														<select name="idMunicipiof" id="idMunicipiof" required disabled="disabled" onchange="ValidarMunicipioDirF();">
														
														</select>
													<?php else :?>
														<select name="idMunicipiof" id="idMunicipiof" required disabled="disabled" onchange="ValidarMunicipioDirF();">
															<option value="<?php echo $parametrosProveedores['nameMunicipioFiscal'] ?>">
																<?php echo $parametrosProveedores['nameMunicipioFiscal'] ?>
															</option>
															<?php foreach($parametrosProveedores['municipiosF'] as $nameMuni) :?>
																<option value="<?php echo $nameMuni['municipio'] ?>">
																	<?php echo $nameMuni['municipio'] ?>
																</option>
															<?php endforeach; ?> 	
														</select>
													<?php endif; ?>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_localidad_f">Localidad:</label>
													<input type="text" name="txt_localidad_f" id="localidadf" required disabled="disabled" autocomplete="off" value="<?php echo $parametrosProveedores['nameLocalityFiscal'] ?>" onkeyup="dirtxtViewDirFis(this.form)"/>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
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
												</li>

												<li>
													<label for="lbl_calle_f">Calle:</label>
													<input type="text" name="txt_calle_f"/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<label for="lbl_noext_f">No. Ext:</label>
													<input type="text" name="txt_noext_f"/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<label for="lbl_noint_f">No. Int:</label>
													<input type="text" name="txt_noint_f" />
												</li>

												<li>
													<label for="lbl_col_f">Colonia:</label>
													<input type="text" name="txt_col_f"/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<label for="lbl_ref_f">Referencia:</label>
													<input type="text" name="txt_ref_f"/>	
												</li>
											</ul>
										</li>
									</ul>
								</li>

								<li><a href="#"><b>Direcci&oacute;n F&iacute;sica</b></a>
									<ul>
										<li>	
											<ul>
												<!-- clave razon social -->
												<input type="text"  name="txt_iddir" value="<?php echo $parametrosProveedores['idDire'] ?>" readonly />
												<li>
													<label for="lbl_estado">Estado:</label>
													<select name="idEstado" id="state" required>
														<?php if ($parametrosProveedores['nameEstado'] == "") :?>
															<option value="">Seleccione estado ...</option>
															<?php foreach ($parametrosProveedores['idState'] as $estado) :?>
																<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
															<?php endforeach;?>
														<?php else :?>
															<option value="<?php echo $parametrosProveedores['idState'] ?>"><?php echo $parametrosProveedores['nameEstado'] ?></option>
															<?php foreach ($parametrosContactos['estados'] as $estado) :?>
																<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>
												
												<li>
													<label for="lbl_municipio">Municipio:</label>
													<?php if($parametrosProveedores['nameMunicipio'] == "") :?>	
														<select name="municipio" id="municipio" required disabled="disabled" onchange="ValidarMunicipio();">
														
														</select>
													<?php else :?>
														<select name="municipio" id="municipio" required disabled="disabled" onchange="ValidarMunicipio();">
															<option value="<?php echo $parametrosProveedores['nameMunicipio'] ?>">
																<?php echo $parametrosProveedores['nameMunicipio'] ?>
															</option>
															<?php foreach($parametrosProveedores['municipios'] as $nameMuni) :?>
																<option value="<?php echo $nameMuni['municipio'] ?>">
																	<?php echo $nameMuni['municipio'] ?>
																</option>
															<?php endforeach; ?> 	
														</select>
													<?php endif; ?>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<label for="lbl_localidad">Localidad:</label>
													<input type="text" name="localidad" id="localidad" required disabled="disabled" autocomplete="off" value="<?php echo $parametrosProveedores['nameLocality'] ?>" onkeyup="dirtxtView(this.form)"/>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>

												<li>
													<?php if($parametrosProveedores['nameLocality'] == "") :?>
														<div id="result"></div>
														<?php else :?>
														<div id="result">
															<?php if($parametrosProveedores['localidades'] == NULL) :?>
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

																	<?php foreach($parametrosProveedores['localidades'] as $dir) :?>
																		<tr>
																			<td><?php echo $dir['estado'] ?></td>
																			<td><?php echo $dir['municipio'] ?></td>
																			<td><?php echo $dir['localidad'] ?></td>
																			<td><?php echo $dir['codigoP'] ?></td>
																			<?php if($dir['id_cp'] == $parametrosProveedores['cp']) :?>
																				<td><input type="radio" name="idcp-locality" checked="checked" value="<?php echo $dir['id_cp'] ?>"/></td>
																				<?php else :?>
																					<td><input type="radio" name="idcp-locality" value="<?php echo $dir['id_cp'] ?>" /></td>
																			<?php endif; ?>
																		</tr>
																	<?php endforeach; ?>
																</table>
															<?php endif; ?>
														</div>
													<?php endif; ?>
												</li>

												<li>
													<label for="lbl_calle">Calle:</label>
													<input type="text" name="txt_calle" required onChange="conMayusculas(this)"/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<div id="result"></div>
												</li>

												<li>
													<label for="lbl_noext">No. Ext:</label>
													<input type="text" name="txt_noext" required/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<label for="lbl_noint">No. Int:</label>
													<input type="text" name="txt_noint" />
												</li>

												<li>
													<label for="lbl_col">Colonia:</label>
													<input type="text" name="txt_col" required onChange="conMayusculas(this)"/>
													<span style="color: red;"><b>&nbsp;*</b></span>	
												</li>

												<li>
													<label for="lbl_ref">Referencia:</label>
													<input type="text" name="txt_ref" onChange="conMayusculas(this)"/>	
												</li>
											</ul>
										</li>
									</ul>
								</li>

								<li><a href="#"><b>Datos Contacto</b></a>
									<ul>
										<li>	
											<ul>
												
													<a href="javascript:abrir()">
														<img alt="Nuevo Contacto" title="Nuevo Contacto" src="images/new-contacto.png">
													</a>
													<!-- <a href=""><img alt="Selecionar Contacto" title="Seleccionar Contacto" src="images/select-contacto.png"></a> -->
													
											</ul>
										</li>
									</ul>
								</li>

								<li><a href="#"><b>Datos Bancarios</b></a>
									<ul>
										<li>
											<ul>
												<!-- <form action="" name="frm_dbank" id="frm_dbank" method="POST" target="_self"> -->
													<!-- clave datos bancarios -->
														<input type="hidden"  name="txt_iddb" value="<?php echo $parametrosProveedores['idBank'] ?>" readonly />
													<li>
														<label for="lbl_banco">Banco:</label>
														<select id="banco" name="slt_banco" required>
															<option value selected>Selecciona un banco...</option>
															<?php foreach($parametrosProveedores ['banco'] as $bank) : ?>
															<option value="<?php echo $bank['id_banco'] ?>"><?php echo $bank['nombre_banco'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>
														
													<li>
														<label for="lbl_sucursal">Sucursal:</label>
														<input type="text" name="txt_suc" id="" required onChange="conMayusculas(this)"/>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<label for="lbl_titular">Titular:</label>
														<input type="text" name="txt_titul" required onChange="conMayusculas(this)"/>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<label for="lbl_cuenta">No. Cuenta:</label>
														<input type="text" name="txt_cuenta" maxlength="20" required/>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<label for="lbl_clabe">Clabe Interbancaria:</label>
														<input type="text" name="txt_clabe" maxlength="18" required/>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<label for="lbl_tipo_cuenta">Tipo de cuenta:</label>
														<select id="tipo_c" name="slt_tipo_c" required>
															<option value selected>Selecciona un tipo de cuenta...</option>
															<?php foreach ($parametrosProveedores ['tipo_cta'] as $tipo_c) : ?>
															<option value="<?php echo $tipo_c['id_tipo_cuenta'] ?>"><?php echo $tipo_c['tipo_cuenta'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<input type="submit" name="btnAddBank" id="btnAddBank" value="Agregar"/>
													</li>
												<!-- </form> -->
												<!-- <div id="datos_bancarios"></div> -->
											</ul>
										</li>
									</ul>
								</li>
									<!-- boton -->
									<input type="submit" class="boton2" id="" value="Guardar" name="btnGuardar" />
									&nbsp;&nbsp;
									<a href="index.php?url=Proveedores" title="Regresar" onclick="return confirm('¿Desea salir antes de guardar?');">
										<input type="button" class="boton2" value="Cancelar" />
									</a>
							</form>
						</ul>
					</div> <!-- fin de div menu-pro -->
				</section> <!-- fin de seccion principal -->
			</div> <!-- fin de div panel-body -->
		</div> <!-- fin de div panel-default -->
	</div> <!-- fin de div col-lg-14 -->

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
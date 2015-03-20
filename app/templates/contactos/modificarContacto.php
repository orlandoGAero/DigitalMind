<!-- Modificar Contacto -->
<?php ob_start() ?>
	<?php $obtenerDatosContacto['id_contacto'] ?>
	
	<?php if (isset($parametrosContactos['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $parametrosContactos['mensaje'] ?></span></b>
	<?php endif; ?>
	 <br/>
	 <!-- Style CSS valid & invalid-->
        <link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />
        
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	 	
	<div class="col-lg-14">
        <div class="panel panel-default">
			<h1>Editar Contacto</h1>
				<div class="panel-heading">    </div>
			    <div class="panel-body">	
					<section id="principal">
						<div class="menu-pro">
							<ul>
								<?php echo"<form action='index.php?url=updateContact&idContact=".$obtenerDatosContacto['id_contacto']."' method='POST' id='formContact' target='_self' >"; ?>
									<li><a href="#">Datos Contacto</a>
										<ul>
											<li>
												
												<span class="span">&nbsp;* Información requerida</span>
												
												<ul>
													<li> <!-- IdContacto -->  <input type="hidden" name="idContact" value="<?php echo $obtenerDatosContacto['id_contacto']  ?>" readonly /> </li>
													<li><label>Nombre</label><input type="text" name="nameContact" autofocus="autofocus" autocomplete="off" required="required" maxlength="50"  pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $obtenerDatosContacto['nombreCon'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Apellido Paterno</label><input type="text" name="ApPContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|"  value="<?php echo $obtenerDatosContacto['ap_paterno'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Apellido Materno</label><input type="text" name="ApMContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $obtenerDatosContacto['ap_materno'] ?>" onChange="conMayusculas(this)"/><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Área</label><input type="text" name="nameArea" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $obtenerDatosContacto['nombre_area'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp*</b></span></li>
													<li><label>Teléfono Móvil</label><input type="text" id="tel" class="keysNumbers" name="telMovil" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $obtenerDatosContacto['movil'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<?php if($obtenerDatosContacto['whatsapp'] == "No") :?>
														<li>
															<?php $valorTrue = "Si" ?>
															<strong>¿Utilizas <img src="images/whatsapp.png" title="WhatsApp"/>?</strong>
															<input type="radio" name="whatsappMovil" value="<?php echo $valorTrue ?>"/>Si
															<input type="radio" name="whatsappMovil" value="<?php echo $obtenerDatosContacto['whatsapp'] ?>" checked="checked"/>No
														</li>
													<?php else :?>
														<li>
															<?php $valorFalse = "No" ?>
															<strong>¿Utilizas <img src="images/whatsapp.png" title="WhatsApp"/>?</strong>
															<input type="radio" name="whatsappMovil" value="<?php echo $obtenerDatosContacto['whatsapp'] ?>" checked="checked"/>Si
															<input type="radio" name="whatsappMovil" value="<?php echo $valorFalse ?>"/>No
														</li>
													<?php endif; ?>
													<li><label>Extensión</label><input type="text" id="tel" class="keysNumbers" name="extC" autocomplete="off" required="required" maxlength="3" pattern="[0-9]{3}" value="<?php echo $obtenerDatosContacto['extension'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Teléfono Oficina</label><input type="text" id="tel" class="keysNumbers" name="telOficina" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $obtenerDatosContacto['tel_oficina'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Teléfono Emergencia</label><input type="text" id="tel" class="keysNumbers" name="telEmergencia" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $obtenerDatosContacto['tel_emergencia'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Correo Personal</label><input type="email" name="emailPersonal" autocomplete="off" required="required" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $obtenerDatosContacto['correo_p'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Correo Institucional</label><input type="email" name="emailInstitucional" autocomplete="off" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $obtenerDatosContacto['correo_instu'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Facebook </label><input type="text" name="redSocialF"  autocomplete="off" maxlength="20" pattern="^[a-z\d\.]{5,}$" value="<?php echo $obtenerDatosContacto['facebook'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Twitter</label><input type="text" name="redSocialT" autocomplete="off" maxlength="20" value="<?php echo $obtenerDatosContacto['twitter'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Skype</label><input type="text" name="redSocialS"  autocomplete="off" maxlength="20" value="<?php echo $obtenerDatosContacto['skype'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Página Web</label><input type="url" name="webPage"  autocomplete="off" maxlength="30" placeholder="http://www.ejemplo.com" value="<?php echo $obtenerDatosContacto['direccion_web'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<?php if ($obtenerDatosContacto['activo'] == "Si") :?>
														<li class="li_radio" >
															<label>Activo</label>
															<input type="radio" name="activoC" value="Si" checked  /> Si
															<input type="radio" name="activoC" value="No" /> No
														</li>
													<?php else :?>
														<li class="li_radio" >
															<label>Activo</label>
															<input type="radio" name="activoC" value="Si" /> Si
															<input type="radio" name="activoC" value="No" checked /> No
														</li>
													<?php endif; ?>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="#" >Datos Dirección Física</a>
										<ul>
											<li>
												
												<span class="span"''>&nbsp;* Información requerida</span>
												
												<ul>
													<li><!-- IdDirección --><input type="hidden"  name="idAddress" value="<?php echo $obtenerDatosContacto['id_direccion'] ?>" readonly /></li>
													<li>
														<label>Estado</label>
														<select name="idEstado" id="state" required='required' onchange="habilitar(this.value);">
															<?php if($obtenerDatosContacto['estado'] == "") :?>
																<option value="">Seleccione estado</option>
																<?php foreach ($obtenerDatosContacto['id_estado'] as $estado) :?>
																	<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
																<?php endforeach; ?>
															<?php else :?>
																<option value="<?php echo $obtenerDatosContacto['id_estado'] ?>"><?php echo $obtenerDatosContacto['estado'] ?></option>
																<?php foreach ($obtenerDatosDir['estados'] as $estado) :?>
																	<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
																<?php endforeach; ?>
															<?php endif; ?>
														</select>
														<span style="color: red;"><b>*</b></span>
													</li>
													<li>
															<label>Municipio</label>
															<?php if($obtenerDatosContacto['municipio'] == "") :?>
																<select name="municipio" id="municipio" required='required' disabled="disabled">
																	
																</select>
															<?php else :?>
																<select name="municipio" id="municipio" required='required'>
																	<option value="<?php echo $obtenerDatosContacto['municipio'] ?>"><?php echo $obtenerDatosContacto['municipio'] ?></option>
																	<?php foreach ($obtenerDatosDir['municipios'] as $nameMunicipality) : ?>
																			<option value="<?php echo $nameMunicipality['municipio'] ?>"> <?php echo $nameMunicipality['municipio'] ?> </option> ?>
																	<?php endforeach; ?>
																</select>
															<?php endif; ?>
															<span style="color: red;"><b>*</b></span>
													</li>
													<?php if(!isset($obtenerDatosContacto['localidadAfter'])) :?>
														<li>
															<label>Localidad</label>
															<input type="text" name="localidad" id="localidad" required="required" autocomplete="off"  maxlength="50" value="<?php echo $obtenerDatosContacto['localidad'] ?>" onkeyup="dirtxtView(this.form)" />
															<span style="color: red;"><b>&nbsp;*</b></span>
														</li>
														<li>
															<?php if($obtenerDatosContacto['localidad'] != "") :?>
																<div id="result">
																	<table class="table" id="miTabla">
																		<tr>
																			<th>Estado</th>
																			<th>Municipio</th>
																			<th>Localidad</th>
																			<th>CP</th>
																			<th>Elegir</th>
																		</tr>
																		
																		<?php foreach ($obtenerDatosDir['localidades'] as $Dir) : ?>
																			<tr>
																				<td><?php echo $Dir['estado'] ?></td>
																				<td><?php echo $Dir['municipio'] ?></td>
																				<td><?php echo $Dir['localidad'] ?></td>
																				<td><?php echo $Dir['codigoP'] ?></td>
																				<td><input type="radio" name="idcp-locality" checked="checked" value="<?php echo $Dir['id_cp'] ?>"/></td>
																			</tr>
																		<?php endforeach; ?>
																	</table>
																</div>
															<?php endif; ?>
														</li>
													<?php else :?>
															<li>
																<label>Localidad</label>
																<input type="text" name="localidad" id="localidad" required="required" autocomplete="off"  maxlength="50" value="<?php echo $obtenerDatosContacto['localidadAfter'] ?>" onkeyup="dirtxtView(this.form)" />
																<span style="color: red;"><b>&nbsp;*</b></span>
															</li>
															<li>
																<div id="result">
																	<?php if($obtenerDatosContacto['localidades'] == NULL) :?>
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
																			
																			<?php foreach ($obtenerDatosContacto['localidades'] as $Dir) : ?>
																				<tr>
																					<td><?php echo $Dir['estado'] ?></td>
																					<td><?php echo $Dir['municipio'] ?></td>
																					<td><?php echo $Dir['localidad'] ?></td>
																					<td><?php echo $Dir['codigoP'] ?></td>
																					<?php if($Dir['id_cp'] == $obtenerDatosContacto['id_cp']) :?>
																						<td><input type="radio" name="idcp-locality" checked="checked" value="<?php echo $Dir['id_cp'] ?>"/></td>
																					<?php else :?>
																						<td><input type="radio" name="idcp-locality" value="<?php echo $Dir['id_cp'] ?>"/></td>
																					<?php endif; ?>
																				</tr>
																			<?php endforeach; ?>
																		</table>
																	<?php endif; ?>
																</div>
															</li>
													<?php endif ?>
													<!-- ======================================================================================================================================================================================================================================================================================================
													<li><label>Código Postal</label><input type="text" class="keysNumbers" name="postcode" autocomplete="off" required="required"  maxlength="5"  pattern="[0-9]{4,5}" value="<?php echo $obtenerDatosContacto['codigoP'] ?>" onKeyUp="cpview(this.form)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<?php if($obtenerDatosContacto['codigoP'] == "") :?>
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
																		<td><?php echo $obtenerDatosContacto['estado'] ?> <input type="hidden" name="state" readonly="readonly" value="<?php echo $obtenerDatosContacto['estado'] ?>" </td>
																		<td><?php echo $obtenerDatosContacto['municipio'] ?>  <input type="hidden" name="municipality" readonly="readonly" value="<?php echo $obtenerDatosContacto['municipio'] ?>" </td>
																		<td>
																			<select id="loc" name="idcp-locality" >
																				<?php if($obtenerDatosContacto['localidad'] != "") :?>
																					<option value="<?php echo $obtenerDatosContacto['id_cp'] ?>"><?php echo $obtenerDatosContacto['localidad'] ?></option>
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
													================================================================================================================================================-->
													<li><label>Calle</label><input type="text" name="street" autocomplete="off" required="required" maxlength="50" value="<?php echo $obtenerDatosContacto['calle'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Número Exterior</label><input type="text" class="keysNumbers" name="numExt" autocomplete="off" required="required" maxlength="5" value="<?php echo $obtenerDatosContacto['num_ext'] ?>"  /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Número Interior</label><input type="text" class="keysNumbers" name="numInt" autocomplete="off" maxlength="5" value="<?php echo $obtenerDatosContacto['num_int'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Colonia</label><input type="text" name="colonia" autocomplete="off" required="required" maxlength="50" value="<?php echo $obtenerDatosContacto['colonia'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Referencia</label><input type="text" name="reference" autocomplete="off" value="<?php echo $obtenerDatosContacto['referencia'] ?>" onChange="conMayusculas(this)" />&nbsp;&nbsp;&nbsp;</li>
												</ul>
											</li>
										</ul>
									</li>
										<!-- Botones -->
										<input type="submit" class="boton2" value="Actualizar" name="btnActualizar" id="btnActualizar"/>
										&nbsp;&nbsp;
										<a href="index.php?url=listContact" title="Regresar" onclick="return confirm('¿Desea salir antes de actualizar?');">
											<input type="button" class="boton2" value="Cancelar" />
										</a>
									
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
		
		function habilitar(value){
			
			if(value >= 1 || value==true){
				// habilitamos
				document.getElementById("municipio").disabled=false;
			}else if(value != "" || value==true){
				// habilitamos
				document.getElementById("localidad").disabled=false;
			}else{
				// deshabilitamos
				document.getElementById("municipio").disabled=true;
				document.getElementById("localidad").disabled=true;
			}
		}
		
		$(function () {
			$('#state').change(function(a){
				$('#municipio').load('index.php?url=viewMunicipality&state=' + this.options[this.selectedIndex].value );
			});
		})
		
		function dirtxtView(form){
	       $('#result').load('index.php?url=viewDirLocality&idEstado=&municipio=&localidad=' + $('#formContact').serialize())    
		}
		
		// function cpview(form)
		// {
	       // $('#resultado').load('index.php?url=obtenerDir&postcode=' + $('#formContact').serialize())    
		// }
		
		jQuery(document).ready(function() {
		    jQuery('.keysNumbers').keypress(function(tecla) {
		        if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		    });
		});
		
	    function conMayusculas(field) {
	            field.value = field.value.toUpperCase()
		}
	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
<!-- Insertar Contacto -->
<?php ob_start() ?>

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
			<h1><!--<img src="images/salir.png" width="30px" height="30px" />-->Nuevo Contacto</h1>
				<div class="panel-heading">    </div>
			    <div class="panel-body">	
					<section id="principal">
						<div class="menu-pro">
							<ul>
								<form action="index.php?url=insertContact" method="POST" id="formContact" target="_self">
									<li><a href="#">Datos Contacto</a>
										<ul>
											<li>
												
												<span class="span">&nbsp;* Información requerida</span>
												
												<ul>
													<li> <!-- IdContacto -->  <input type="hidden" name="idContact" value="<?php echo $parametrosContactos['idCont']  ?>" readonly /> </li>
													<li><label>Nombre</label><input type="text" name="nameContact" autofocus="autofocus" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $parametrosContactos['nombre'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Apellido Paterno</label><input type="text" name="ApPContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|"value="<?php echo $parametrosContactos['app'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Apellido Materno</label><input type="text" name="ApMContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $parametrosContactos['apm'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Área</label><input type="text" name="nameArea" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" value="<?php echo $parametrosContactos['area'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp*</b></span></li>
													<li><label>Teléfono Móvil</label><input type="text" id="tel" class="keysNumbers" name="telMovil" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $parametrosContactos['movil'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<?php if($parametrosContactos['whatsAppC'] == "No") :?>
														<li>
															<?php $valorTrue = "Si" ?>
															<strong>¿Utilizas <img src="images/whatsapp.png" title="WhatsApp"/>?</strong>
															<input type="radio" name="whatsappMovil" value="<?php echo $valorTrue ?>"/>Si
															<input type="radio" name="whatsappMovil" value="<?php echo $parametrosContactos['whatsAppC'] ?>" checked="checked"/>No
														</li>
													<?php else :?>
														<li>
															<?php $valorFalse = "No" ?>
															<strong>¿Utilizas <img src="images/whatsapp.png" title="WhatsApp"/>?</strong>
															<input type="radio" name="whatsappMovil" value="<?php echo $parametrosContactos['whatsAppC'] ?>" checked="checked"/>Si
															<input type="radio" name="whatsappMovil" value="<?php echo $valorFalse ?>"/>No
														</li>
													<?php endif; ?>
													<li><label>Extensión</label><input type="text" id="tel" class="keysNumbers" name="extC" autocomplete="off" required="required" maxlength="3" pattern="[0-9]{3}" value="<?php echo $parametrosContactos['ext'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Teléfono Oficina</label><input type="text" id="tel" class="keysNumbers" name="telOficina" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $parametrosContactos['tel_ofi'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Teléfono Emergencia</label><input type="text" id="tel" class="keysNumbers" name="telEmergencia" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" value="<?php echo $parametrosContactos['tel_emer'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Correo Personal</label><input type="email" name="emailPersonal" autocomplete="off" required="required" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $parametrosContactos['correoPers'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Correo Institucional</label><input type="email" name="emailInstitucional" autocomplete="off" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $parametrosContactos['correoInsti'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Facebook </label><input type="text" name="redSocialF"  autocomplete="off" maxlength="20" pattern="^[a-z\d\.]{5,}$" value="<?php echo $parametrosContactos['RSFacebook'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Twitter</label><input type="text" name="redSocialT" autocomplete="off" maxlength="20" value="<?php echo $parametrosContactos['RSTwitter'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Skype</label><input type="text" name="redSocialS"  autocomplete="off" maxlength="20" value="<?php echo $parametrosContactos['RSSkype'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Página Web</label><input type="url" name="webPage"  autocomplete="off" maxlength="30" placeholder="http://www.ejemplo.com" value="<?php echo $parametrosContactos['pagWeb'] ?>" />&nbsp;&nbsp;&nbsp;</li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="#" >Datos Dirección Física</a>
										<ul>
											<li>
												
												<span class="span"''>&nbsp;* Información requerida</span>
												
												<ul>
													<li><!-- IdDirección --><input type="hidden"  name="idAddress" value="<?php echo $parametrosContactos['idDir'] ?>" readonly /></li>
													<li>
														<label>Estado</label>
														<select name="stateCont" id="state" required='required' onchange="habilitar(this.value);">
															<?php if($parametrosContactos['estadoC'] != "") :?>
																<option value="">Seleccione estado</option>
															<?php else :?>
																<option value="<?php $parametrosContactos['estadoC'] ?>"><?php $parametrosContactos['estadoC'] ?></option>
															<?php endif; ?>
															<?php foreach ($parametrosContactos['estadoC'] as $estado) :?>
															<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>*</b></span>
													</li>
													<li>
														<!-- <div id="result_municipio">  -->
															<label>Municipio</label>
															<select name="municipio" id="municipio" required='required' disabled="disabled">
																
															</select>
															<span style="color: red;"><b>*</b></span>
														<!-- </div> -->
													</li>
													<li>
														<!-- <div id="result_localidad"> -->
															<label>Localidad</label>
															<input type="text" name="localidad" id="localidad" onkeyup="dirtxtView(this.form)" />
															<span style="color: red;"><b>&nbsp;*</b></span>
														<!-- </div> -->
													</li>
													<li>
														<div id="result"></div>
													</li>
													
													<!-- ========================================================================================================================= -->
													<!-- <li><label>Código Postal</label><input type="text" class="keysNumbers" name="postcode" autocomplete="off" required="required"  maxlength="5"  pattern="[0-9]{4,5}" value="<?php echo $parametrosContactos['cp'] ?>" onKeyUp="cpview(this.form)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<?php if($parametrosContactos['cp'] == "") :?>
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
																		<td><?php echo $parametrosContactos['estado'] ?> <input type="text" name="state" readonly="readonly" value="<?php echo $parametrosContactos['estado'] ?>" </td>
																		<td><?php echo $parametrosContactos['municipio'] ?>  <input type="text" name="municipality" readonly="readonly" value="<?php echo $parametrosContactos['municipio'] ?>" </td>
																		<td>
																			<select name="idcp-locality" required='required'>
																				<?php if($parametrosContactos['localidadC'] != "") :?>
																					<option value="<?php echo $parametrosContactos['idCP'] ?>"><?php echo $parametrosContactos['localidadC'] ?></option>
																				<?php else :?>
																					<option value="">Seleccione una Opción</option>
																				<?php endif; ?>
																				<?php foreach ($parametrosContactos['codigoP'] as $locality) : ?>
																						<option value="<?php echo $locality['id_cp'] ?>"> <?php echo $locality['localidad'] ?> </option> ?>
																				<?php endforeach; ?>
																			</select>
																		</td>
																	</tr> 
																</table>
															</div>
														</li>
													<?php endif; ?> -->
													<!-- ============================================================================================================================= -->
													<li><label>Calle</label><input type="text" name="street" autocomplete="off" required="required" maxlength="50" value="<?php echo $parametrosContactos['calleD'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Número Exterior</label><input type="text" class="keysNumbers" name="numExt" autocomplete="off" required="required" maxlength="5" value="<?php echo $parametrosContactos['numExterior'] ?>" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Número Interior</label><input type="text" class="keysNumbers" name="numInt" autocomplete="off" maxlength="5" value="<?php echo $parametrosContactos['numInterior'] ?>" />&nbsp;&nbsp;&nbsp;</li>
													<li><label>Colonia</label><input type="text" name="colonia" autocomplete="off" required="required" maxlength="50" value="<?php echo $parametrosContactos['coloniaD'] ?>" onChange="conMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li><label>Referencia</label><input type="text" name="reference" autocomplete="off" value="<?php echo $parametrosContactos['referenciaD'] ?>" onChange="conMayusculas(this)" />&nbsp;&nbsp;&nbsp;</li>
												</ul>
											</li>
										</ul>
									</li>
										<!-- Botones -->
										<input type="submit" class="boton2" value="Guardar" name="btnGuardar" />
										&nbsp;&nbsp;
										<a href="index.php?url=listContact" title="Regresar" onclick="return confirm('¿Desea salir antes de guardar?');">
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
		
		function habilitar(value)
		{
			
			if(value >= 1 || value==true)
			{
				// habilitamos
				document.getElementById("municipio").disabled=false;
			}else if(value != "" || value==true)	{
				// habilitamos
				document.getElementById("localidad").disabled=false;
			}else{
				// deshabilitamos
				document.getElementById("municipio").disabled=true;
				document.getElementById("localidad").disabled=true;
			}
		}
			// function dirtxtView(form)
		// {
		// {
			// if(value >= 1 || value==true)
			// {
				// // habilitamos
				// document.getElementById("municipio").disabled=false;
			// }else{
				// // deshabilitamos
				// document.getElementById("municipio").disabled=true;
			// }
		// }
// 		
		// function habilitar2(value)
		// {
			// if(value != "" || value==true)
			// {
				// // habilitamos
				// document.getElementById("localidad").disabled=false;
			// }else{
				// // deshabilitamos
				// document.getElementById("localidad").disabled=true;
			// }
		// }
		
		$(function () {
			$('#state').change(function(a){
				$('#municipio').load('index.php?url=viewMunicipality&state=' + this.options[this.selectedIndex].value );
			});
		})
		
		function dirtxtView(form)
		{
	       $('#result').load('index.php?url=viewDirLocality&stateCont=&municipio=&localidad=' + $('#formContact').serialize())    
		}
		
		function cpview(form)
		{
	       $('#resultado').load('index.php?url=obtenerDir&postcode=' + $('#formContact').serialize())    
		}
		
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
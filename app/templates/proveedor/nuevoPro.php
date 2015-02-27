<?php ob_start() ?>

	<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/estilos.css">
			<link rel="stylesheet" type="text/css" href="css/style-stepscontact.css">

			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    		<script type="text/javascript" src="js/formToWizard.js"></script>
		    <script type="text/javascript">
		        $(document).ready(function(){
		            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })
		        });
		    </script>

		    <!-- JS Formulario Listas Desplegables -->
			<!-- modificar linea de abajo-->
			<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
			<script>
				$('document').ready(function(){
					$('.menu-pro').lksMenu();
				});
			</script>
			<script type="text/javascript">
				$('document').ready(function()
				{
					$('#tablaCont').load('index.php?url=TablaContactos');
				});
			</script>
		</head>
		<body>
			<section id="contenido">
				<div align="left"><a href="index.php?url=Proveedores"><img src="images/leftarrow.png"></a></div>
				<section id="principal">
					<h1>Nuevo Proveedor</h1>
					<div class="menu-pro">
						<form action="index.php?url=NuevoProveedor" method="POST" name="formprov" id="formprov">
							<fieldset>
								<ul>
									<li><a href="#">Datos Proveedor</a>
										<ul>
											<li>	
												<div class="dform">
													<div>
														<input type="hidden" name="idProv" value="<?php echo $parametrosProveedores['idprov'] ?>" readonly/>
													</div>

													<div>
														<label for="fecha">Fecha Alta:</label>
														<input type="date" name="f_alta" value="<?php echo date("Y-m-d"); ?>" readonly class="date"/>
													</div>

													<div>
														<label for="proveedor">Proveedor:</label>
														<input type="text" name="nombrepro"/>
													</div>

													<div>
														<label for="categoria">Categor&iacute;a:</label>
														<select id="catprov" name="catprov">
															<option value selected>Ingresa una categor&iacute;a...</option>
															<?php foreach ($parametrosProveedores['categoriaprov'] as $catpro) : ?>
															<option value="<?php echo $catpro['categoria'] ?>"><?php echo $catpro['categoria']?></option>
															<?php endforeach; ?>
														</select>
													</div>

													<div>
														<label for="tele">Tel&eacute;fono:</label>
														<input type="tel" name="tel_pro" maxlength="10" />
													</div>

													<div>
														<label for="dir">Direcci&oacute;n Web:</label>
														<input type="url" name="url_web" placeholder="http://dominio.com.mx" />
													</div>
												</div>
											</li>
										</ul>
									</li>

									<li><a href="#">Datos Fiscales</a>
										<ul>
											<li>	
												<div class="dform">
													<div>
														<label for="razon">Raz&oacute;n Social:</label>
														<input type="text" name="razon_s" />
													</div>

													<div>
														<label for="rfc">RFC:</label>
														<input type="text" name="rfc"/>
													</div>

													<div>
														<label for="tipo">Tipo Raz&oacute;n:</label></td>
														<select id="tipo_rs" name="tipo_rs">
																<option value selected>Ingresa un tipo de raz&oacute;n...</option>
																<?php foreach($parametrosProveedores ['tipo_razon'] as $tipors) : ?>
																<option value="<?php echo $tipors['tipo'] ?>"><?php echo $tipors['tipo'] ?></option>
																<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
										</ul>
									</li>

									<li><a href="#">Datos Direcci&oacute;n F&iacute;sica</a>
										<ul>
											<li>	
												<div class="dform">
													<div>
														
													</div>
												</div>
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

									<li><a href="#">Datos Bancarios</a>
										<ul>
											<li>
											<div class="dform">
												<div>
													<label for="banco">Banco:</label>
													<select id="banco" name="banco">
														<option value selected>Selecciona un banco...</option>
														<?php foreach($parametrosProveedores ['banco'] as $bank) : ?>
														<option value="<?php echo $bank['nombre_banco'] ?>"><?php echo $bank['nombre_banco'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
													
												<div>
													<label for="sucursal">Sucursal:</label>
													<input type="text" name="suc" id=""/>
												</div>

												<div>
													<label for="titular">Titular:</label>
													<input type="text" name="titul" />
												</div>

												<div>
													<label for="cuenta">No. Cuenta:</label>
													<input type="text" name="cuenta"/>
												</div>

												<div>
													<label for="clabe">Clabe Interbancaria:</label>
													<input type="text" name="clabe" maxlength="18"/>
												</div>

												<div>
													<label for="tipo_cuenta">Tipo de cuenta:</label>
													<select id="tipo_c" name="tipo_c">
														<option value selected>Selecciona un tipo de cuenta...</option>
														<?php foreach ($parametrosProveedores ['tipo_cta'] as $tipo_c) : ?>
														<option value="<?php echo $tipo_c['tipo_cuenta'] ?>"><?php echo $tipo_c['tipo_cuenta'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											</li>
										</ul>
									</li>
								</ul>

								<div>
									<input type="submit" class="" id="" value="Guardar" name="btnGuardar" />
								</div>

							</fieldset>
						</form>
					</div>
				</section>
			</section>
		</body>
	</html>
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
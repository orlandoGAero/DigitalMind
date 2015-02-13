<?php ob_start() ?>

	<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/estilos.css">
			 <!-- JS Formulario Listas Desplegables -->
			 
			
			<!-- modificar linea de abajo-->
			<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
			<script>
				$('document').ready(function(){
					$('.menu-pro').lksMenu();
				});
			</script>
			<!--Scripts para el funcionamiento de la ventana-->
			<script>
				!window.jQuery && document.write('\x3cscript src=\x22js/fancybox/jquery-1.4.3.min.js\x22\x3e \x3C/script\x22');
			</script>
			<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
			<link rel="stylesheet" type="text/css" href="css/fancybox/fancybox.css" media="screen" />
			<script type="text/javascript">
				$('document').ready(function() {
					$('#various2').fancybox();
				});
				$('document').ready(function() {
					$('#various1').fancybox();
				});
			</script>
			<!-- fin de scripts -->
		</head>
		<body>

		<section id="contenido">
			<div align="left"><a href="index.php?url=Proveedores"><img src="images/leftarrow.png"></a></div>
			<section id="principal">
				<div class="menu-pro">
					<form action="" name="" id="" method="" class="cmxform">
						<fieldset>
							<ul>
								<li><a href="#">Datos Proveedor</a>
									<ul>
										<li>	
											<div class="dform">
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
													<select>
														<option value selected>Ingresa una categor&iacute;a...</option>
														<option></option>
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
													<select>
															<option value selected>Ingresa un tipo de raz&oacute;n...</option>
															<option></option>
													</select>
												</div>
											</div>
										</li>
									</ul>
								</li>

								<li><a href="#">Datos Direcci&oacute;n F&iacute;sica</a>
									<ul>
										<li>	
											<div>
												
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
															<td><a href="#contact" id="various1"><img alt="Selecciona Contacto" title="Selecciona Contacto" src="images/select-contacto.png"></a></td>
															<td><a href=""><img alt="Nuevo Contacto" title="Nuevo Contacto" src="images/new-contacto.png"></a></td>
														   </tr>
													</table>
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
												<select>
													<option value selected>Selecciona un banco...</option>
													<option></option>
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
												<label for="tipo_cuenta"></label>
												<select>
													<option value selected>Selecciona un tipo de cuenta...</option>
													<option></option>
												</select>
											</div>
										</div>
										</li>
									</ul>
								</li>
							</ul>
						</fieldset>
					</form>
				</div>
			</section>
		</section>
			<!-- div para ventana emergente -->
			<div style="display: none;">
				<!-- contenido de la ventana emergente -->
				<div id="contact" style="width:600px;height:350px;overflow:auto;">
					
				</div>
			</div>
		</body>
	</html>
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
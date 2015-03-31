<?php ob_start() ?>
	
	<!-- Style CSS valid & invalid-->
 	<link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />	<!-- JS Formulario Listas Desplegables -->
	
	<!-- JS Formulario Listas Desplegables -->
	<!-- modificar linea de abajo-->
	<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});

		/*Funcion para Agregar Datos Bancarios*/
		$(function (agregar) {
			$('#frm_dbank').submit(function (agregar) {
				agregar.preventDefault()
				$('#datos_bancarios').load('index.php?url=DatosBancarios&div=frmDB&' + $('#frm_dbank').serialize())
			});
		});

		function conMayusculas(field) {
	        field.value = field.value.toUpperCase()
		}
	</script>

	<div class="col-lg-14">
		<div class="panel panel-default">
			<h1>Nuevo Proveedor</h1>
			<div class="panel-heading" style="height:40px;">
				<span class="span">&nbsp;* Información requerida</span>
				
			</div> <!-- panel-heading -->
			<div class="panel-body">
				<section id="principal">
					<div class="menu-pro">
						<ul>
							<li><a href="#"><b>Datos Contacto</b></a>
								<ul>
									<li>	
										<ul>
											<h1>Contactos</h1>
										</ul>
									</li>
								</ul>
							</li>

							<li><a href="#"><b>Datos Bancarios</b></a>
								<ul>
									<li>
										<ul>
											<div id="datos_bancarios">
												<form action="" method="POST" name="frm_dbank" id="frm_dbank" target="_self">
													<!-- clave datos bancarios -->
														<input type="text"  name="txt_iddb" value="<?php echo $parametrosDatosBank['idBank'] ?>" readonly />
													<li>
														<label for="lbl_banco">Banco:</label>
														<select id="banco" name="slt_banco" required>
															<option value selected>Selecciona un banco...</option>
															<?php foreach($parametrosDatosBank ['banco'] as $bank) : ?>
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
															<?php foreach ($parametrosDatosBank ['tipo_cta'] as $tipo_c) : ?>
															<option value="<?php echo $tipo_c['id_tipo_cuenta'] ?>"><?php echo $tipo_c['tipo_cuenta'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>&nbsp;*</b></span>
													</li>

													<li>
														<input type="text" name="txt_IDProv" value="<?php echo $parametrosProveedores['idprov'] ?>"> 
														<input type="submit" class="boton2" name="btnAddBank" id="btnAddBank" value="Agregar"/>
													</li>
												</form>
											</div> <!-- fin div  datos_bancarios-->
											<div id="table_datos_bancarios"></div>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div> <!-- fin de div menu-pro -->
				</section> <!-- fin de seccion principal -->
			</div> <!-- fin de div panel-body --> 
		</div> <!-- fin de div panel-default -->
	</div> <!-- fin de div col-lg-14 -->

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
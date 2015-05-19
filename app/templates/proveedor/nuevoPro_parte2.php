<?php ob_start() ?>
	
	<!-- Style CSS valid & invalid-->
 	<link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />
	
	<!--librerias-->
	<link rel="stylesheet" href="css/fancybox/jquery.fancybox.css"/>

	<script>window.jQuery || document.write('<script src="js/fancybox/libs/jquery-1.7.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript">
		$('document').ready(function() 
		{
			$('#tablaCont').fancybox();
		});

	  	$('document').ready(function()
		{
			$('#allcontact').load('index.php?url=TablaContactos&idprov=<?php echo $parametrosProveedores['idprov'] ?>');
		});
	</script>
	<!-- JS Formulario Listas Desplegables -->
	<!-- modificar linea de abajo-->
	<!--<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>-->
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

		function abrir_pag(url){
			window.open(url,"Contactos","width=900px,height=400px,top=50px,left=50px,scrollbars=NO,resizable=NO")
		}

		function recargar() {
		    //Invocamos a nuestro script PHP
		    $.post("index.php?url=TablaContactos&idprov=<?php echo $parametrosProveedores['idprov'] ?>", function(data){
		       //Ponemos la respuesta de nuestro script en el DIV recargado
		    $("#allcontact").html(data);
		    });       
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
											<div class="azul">
												<h3>Agregue los contactos del Proveedor</h3></br>
												<a href="javascript:abrir_pag('index.php?url=insertContact')">
													<center><img src='images/new-contacto.png' alt='Nuevo Contacto' title='Nuevo Contacto'></center>
												</a>
												<!-- vinculo para seleccionar un contacto -->
												<a href="#allcontact" id="tablaCont" onclick="javascript:recargar();">
													<img src="images/select-contacto.png" title="Selecciona Contacto" alt="Selecciona Contacto">
												</a>
											</div>
											<div style="display: none;">
												<div id="allcontact" style="width:900px;height:450px;overflow:auto;">
													
												</div>	
											</div>

											<div id="tabla_paginacion">
    
												<!--Aqui cargan las tablas para asignar o eliminar contacto-->  

												<?php
												
												?>
												    no esta cargando nada :(
											    
											</div> 
							 				
											<!-- anterior -->
							 				<!-- <a href="#" onclick="javascript:recargar();">actualizar</a> -->
							 				<!-- div para tabla de contactos -->
							 				<!-- <div id="tablaCont">
							 					
							 				</div> -->
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
														<input type="hidden" name="txt_IDProv" value="<?php echo $parametrosProveedores['idprov'] ?>"> 
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

					<script>
						function confirmar () {
						  msg = confirm('¿Estas seguro que deseas abandonar este proceso?.');
						  return msg;
					  	}
					  
						function GoUrl()
						{
						   window.location.href = "index.php?url=Proveedores";
						}
					 </script>
					
						<a href="javascript:GoUrl()">
							<button class="boton2" onclick="javascript:return confirmar();">Finalizar</button>
						</a>	
					
				</section> <!-- fin de seccion principal -->
			</div> <!-- fin de div panel-body --> 
		</div> <!-- fin de div panel-default -->
	</div> <!-- fin de div col-lg-14 -->

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
<!--  -->
<?php ob_start() ?>

	 <!-- Style CSS valid & invalid-->
        <link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />
        
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	 	
	<div class="col-lg-14">
		<div class="panel panel-default">
			<h1>Nueva Transacción</h1>
			<div class="panel-heading">    </div>
		    <div class="panel-body">	
				<section id="principal">
					<div class="menu-pro">
						<ul>
							<form action="index.php?url=continuarTransaccion" method="POST" id="formTransacion" target="_self">
								<li><a href="#">Datos Transacción</a>
									<ul>
										<li>
											
											<span class="span">&nbsp;* Información requerida</span>
											
											<ul>
												<li>
													<label>Transacción</label>
													<select name="sltTrans" id="tipo_transaccion" required="required" onchange="cargarFormularioTrans(this.form);">
														<option value="" selected="selected" disabled="disabled">Seleccione una transacción</option>
														<option value="1">Compra</option>
														<option value="2">Venta</option>
														<option value="3">Pedido</option>
														<option value="4">Cotización</option>
														<option value="4">Garanttia</option>
														<option value="4">Nota de Credito</option>
														<option value="4">Nota de Venta</option>
													</select>
													<span style="color: red;"><b>&nbsp;*</b></span>
												</li>
												<li>
													<div id="resultado_transaccion"></div>
												</li>
											</ul>
										</li>
									</ul>
								</li>
									<!-- Botones -->
									<input type="submit" class="boton2" value="Continuar" name="btnContinuar" />
									&nbsp;&nbsp;
									<a href="index.php?url=menuTransacciones" title="Regresar" onclick="return confirm('¿Desea salir antes de guardar?');">
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
		
		function cargarFormularioTrans(form) {
	        if ($('#tipo_transaccion').val() != "") {
	        	$('#resultado_transaccion').load('index.php?url=viewFormTrans&' + $('#formTransacion').serialize())	
	        }
		 }
	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
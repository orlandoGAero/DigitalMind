<!-- Insertar Compra -->
<?php ob_start() ?>

	<!-- <?php if (isset($parametrosContactos['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $parametrosContactos['mensaje'] ?></span></b>
	<?php endif; ?> -->
	 <br/>
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
								<form action="index.php?url=compra" method="POST" id="formCompra" target="_self">
									<li><a href="#">Datos Transacción</a>
										<ul>
											<li>
												
												<span class="span">&nbsp;* Información requerida</span>
												
												<ul>
													<li>
														<label>Tipo Transacción</label>
														<select name="sltTrans" required="required">
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
													<li><label>Importe</label><input type="text" class="keysNumbers" name="import" autocomplete="off" required="required" maxlength="10" /><!-- value="<?php echo $parametrosContactos['numExterior'] ?>" --><span style="color: red;"><b>&nbsp;*</b></span></li>
													<li></li>
													<li></li>
												</ul>
											</li>
										</ul>
									</li>
										<!-- Botones -->
										<input type="submit" class="boton2" value="Guardar" name="btnGuardar" />
										&nbsp;&nbsp;
										<a href="index.php?url=inicio" title="Regresar" onclick="return confirm('¿Desea salir antes de guardar?');">
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
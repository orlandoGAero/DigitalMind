<!--  -->
<?php ob_start() ?>

	<!-- Style CSS valid & invalid-->
        <link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />
        
	<!-- JS Formulario Listas Desplegables -->
		<script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	 	
	<div class="col-lg-14">
    	<div class="panel panel-default">
			<h1>Nueva Compra</h1>
			<div class="panel-heading">    </div>
		    <div class="panel-body">	
				<section id="principal">
					<div class="menu-pro">
						<ul>
							<form action="index.php?url=continuarTransaccion" method="POST" id="formTransacionSegundo" target="_self">
								<li><a href="#">Datos Compra</a>
									<ul>
										<li>
											<span class="span">&nbsp;* Información requerida</span>
											<ul>
												<li>
													<div align="left">
														<p><h5><b>&nbsp;&nbsp;&nbsp;No. Compra:</b> <?php echo $parametrosCompra2['noComprovanteC'] ?></h5></p>
														<?php foreach($parametrosCompra2['datosCompra'] as $compra) :?>
															<p><h5><b>&nbsp;&nbsp;&nbsp;Proveedor:</b> <?php echo $compra['proveedor'] ?></h5></p>
															<p><h5><b>&nbsp;&nbsp;&nbsp;Fecha:</b> <?php echo $compra['fecha_compra'] ?></h5></p>
															<p><h5><b>&nbsp;&nbsp;&nbsp;Hora:</b> <?php echo $compra['hora_compra'] ?></h5></p>
														<?php endforeach; ?>
													</div>
													<li><!-- No. Comprobante de Compra --><input type="hidden" name="txtNumCompr" value="<?php echo $parametrosCompra2['noComprovanteC'] ?>" readonly="readonly"/></li>
													<li>
														<label>Productos</label>
														<select name="idProducto" id="id_prod" required="required" >
															<option value="" disabled="disabled">Seleccione producto</option>
															<?php foreach ($parametrosCompra2['productos'] as $proveedor) :?>
																<option value="<?php echo $proveedor['id_producto'] ?>"><?php echo $proveedor['nombre_producto'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>*</b></span>
													</li>
													<li>
														<div id="datosProd"></div>
													</li>
													<li>
														<div id="productosAgregados"></div>
													</li>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								
								<!-- Botones -->

								<a href="index.php?url=transacciones" title="Cancelar" onclick="return confirm('¿Desea salir antes de guardar?');">
									<input type="button" class="boton2" value="Cancelar" style="margin-left: 700px"/>
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
		
		$(function (a) {			
			$('#id_prod').change(function(a)
			{
				$('#datosProd').load('index.php?url=verInfoProd&IDproducto=' + this.options[this.selectedIndex].value);
			});
		});
		
		$(function (e) {
			$('#formTransacionSegundo').submit(function (e) {
				e.preventDefault()
				$('#productosAgregados').load('index.php?url=addProdCompra&' + $('#formTransacionSegundo').serialize())
			})
		})
		
	</script>
	

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
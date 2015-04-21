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
															<?php foreach ($parametrosCompra2['productos'] as $producto) :?>
																<option value="<?php echo $producto['id_producto'] ?>"><?php echo $producto['nombre_producto'] ?></option>
															<?php endforeach; ?>
														</select>
														<span style="color: red;"><b>*</b></span>
													</li>
													<li>
														<div id="datosProd"></div>
													</li>
													<li>
														<div id="productosAgregados">
															<?php if(isset($obtenerDatosProdAddCompr)) :?>
																<?php if($obtenerDatosProdAddCompr != NULL) :?>
																	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
																	<div class="table-responsive">
																		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
																			"id" para incluir los estilos a la tabla -->
																    	<table class="table" id="miTabla">
																    		<caption>Productos Agregados</caption>
																			<thead>
																				<tr>
																					<th><h5>Producto</h5></th>
																					<th><h5>Precio</h5></th>
																					<th><h5>Cantidad</h5></th>
																					<th class="nosort"><h5>Eliminar</h5></th>
																				</tr>
																			</thead>			
																			
																			<?php $costoTotal = 0; ?>
																			
																			<?php foreach($obtenerDatosProdAddCompr as $productAdd) :?>
																				
																				<?php $idPr = $productAdd['id_producto']; ?>
																				
																				<tr>
																					<td><?php echo $productAdd['nombre_producto'] ?></td>
																					<td>$<?php echo number_format($productAdd['precio_unitario'],2,'.',',') ?></td>
																					<td><?php echo $productAdd['cant_producto_compra'] ?></td>
																					<td>
																						<!-- boton borrar -->
																						<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='formBorrar' id='formBorrar' target='_self'>
																						<!-- input hidden-->
																						<input type="hidden"  name="idDetTransCompr" value="<?php echo $productAdd['id_detalle_compra'] ?>" />
																						<input type="hidden"  name="folioCompra" value="<?php echo $productAdd['no_trans_compra'] ?>" />
																						<input type="hidden"  name="idProductoC" value="<?php echo $idPr ?>" />
																						<input type="hidden"  name="cantProdC" value="<?php echo $productAdd['cant_producto_compra'] ?>" />
																						<!-- Botón -->
																						<input type="button" name="btnBorrar" class="boton2 borrarProducto" value="Borrar">
																						</form>
																					</td>
																				</tr>
																				<?php $costoTotal = $costoTotal + $productAdd['precio_unitario'] * $productAdd['cant_producto_compra'] ?>
																			<?php endforeach; ?>
																		</table>
																	</div>
																	<?php echo "<b>Total: $".number_format($costoTotal,2,'.',',')."</b>"  ?>
																<?php else :?>
																	<pre>
																		<h3 class="azul">No se encuentra agregado ningún producto</h3>
																	</pre>
																<?php endif; ?>
															<?php endif; ?>
														</div>
													</li>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								
								<!-- Botones -->

								<a href="index.php?url=menuTransacciones" title="Finalizar" onclick="return confirm('¿Esta seguro de finalizar el proceso?');">
									<input type="button" class="boton2" value="Finalizar" style="margin-left: 700px"/>
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
		
		$(function () {
			$('.borrarProducto').click(
				function () {
					formTransacionSegundo = this.form;
					$('#productosAgregados').load('index.php?url=deleteProdCompra&',$(formTransacionSegundo).serialize());
				}
			);
		});
		
	</script>
	

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
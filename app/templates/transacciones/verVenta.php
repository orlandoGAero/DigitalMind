<!--  -->
<?php ob_start() ?>
	<!-- Style CSS valid & invalid-->
        <link href="<?php echo 'css/'.config::$style_valid_invalid_css ?>" rel="stylesheet" />
        
	<!-- JS Formulario Listas Desplegables -->
		<script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>

		<a href="index.php?url=listarVentas"><img src="images/leftarrow.png" title="Regresar" align='left' width="40px" height="40px" /></a>
		<h3 class="azul">Detalle de Venta</h3>
		<?php if(isset($obtenerDatosProdAddVent)) :?>
			<div align="left">
				<p><h5><b>&nbsp;&nbsp;&nbsp;No. Venta:</b> <?php echo $informacionVenta['noComprovanteV'] ?></h5></p>
				<?php foreach($informacionVenta['datosVenta'] as $venta) :?>
					<p><h5><b>&nbsp;&nbsp;&nbsp;Cliente:</b> <?php echo $venta['nombre'] ?></h5></p>
					<p><h5><b>&nbsp;&nbsp;&nbsp;Fecha:</b> <?php echo $venta['fecha_venta'] ?></h5></p>
					<p><h5><b>&nbsp;&nbsp;&nbsp;Hora:</b> <?php echo $venta['hora_venta'] ?></h5></p>
				<?php endforeach; ?>
			</div>
			<?php if($obtenerDatosProdAddVent != NULL) :?>
				<div id="productosAgregados">
					<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
					<div class="table-responsive">
						<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
							"id" para incluir los estilos a la tabla -->
				    	<table class="table" id="miTabla">
				    		<caption>Productos Agregados</caption>
							<thead>
								<tr>
									<th><h5>Proveedor</h5></th>
									<th><h5>Producto</h5></th>
									<th><h5>Precio</h5></th>
									<th><h5>Cantidad</h5></th>
									<th class="nosort"><h5>Eliminar</h5></th>
								</tr>
							</thead>			
							
							<?php $costoTotal = 0; ?>
							
							<?php foreach($obtenerDatosProdAddVent as $productAdd) :?>
								
								<?php $idPr = $productAdd['id_producto']; ?>
								
								<tr>
									<td><?php echo $productAdd['proveedor'] ?></td>
									<td><?php echo $productAdd['nombre_producto'] ?></td>
									<td>$<?php echo number_format($productAdd['precio_unitario'],2,'.',',') ?></td>
									<td><?php echo $productAdd['cant_producto_venta'] ?></td>
									<td>
										<!-- boton borrar -->
										<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='formBorrar' id='formBorrar' target='_self'>
										<!-- input hidden-->
										<input type="hidden"  name="idDetTransVent" value="<?php echo $productAdd['id_detalle_venta'] ?>" />
										<input type="hidden"  name="folioVenta" value="<?php echo $productAdd['no_trans_venta'] ?>" />
										<input type="hidden"  name="idProductoV" value="<?php echo $idPr ?>" />
										<input type="hidden"  name="cantProdV" value="<?php echo $productAdd['cant_producto_venta'] ?>" />
										<!-- Botón -->
										<input type="button" name="btnBorrar" class="boton2 borrarProducto" value="Borrar">
										</form>
									</td>
								</tr>
								<?php $costoTotal = $costoTotal + $productAdd['precio_unitario'] * $productAdd['cant_producto_venta'] ?>
							<?php endforeach; ?>
						</table>
					</div>
					<?php echo "<b>Total: $".number_format($costoTotal,2,'.',',')."</b>"  ?>
				</div>
			<?php else :?>
				<pre>
					<h3 class="azul">No se encuentra agregado ningún producto</h3>
				</pre>
			<?php endif; ?>
			<br />
			<div class="col-lg-14">
		    	<div class="panel panel-default">
					<h1>Nueva Venta</h1>
					<div class="panel-heading">    </div>
				    <div class="panel-body">	
						<section id="principal">
							<div class="menu-pro">
								<ul>
									<form action="" method="POST" id="formAgregarProducto" target="_self">
										<li><a href="#pincipal">Datos Venta</a>
											<ul>
												<li>
													<span class="span">&nbsp;* Información requerida</span>
													<ul>
														<li>
															<li><!-- No. Comprobante de Venta --><input type="hidden" name="txtNumVenta" value="<?php echo $informacionVenta['noComprovanteV'] ?>" readonly="readonly"/></li>
															<li>
																<label>Proveedores</label>
																<select name="idProveedor" id="id_prove" required="required" >
																	<option value="" disabled="disabled">Seleccione proveedor</option>
																	<?php foreach ($informacionVenta['proveedores'] as $proveedor) :?>
																		<option value="<?php echo $proveedor['id_prov'] ?>"><?php echo $proveedor['proveedor'] ?></option>
																	<?php endforeach; ?>
																</select>
																<span style="color: red;"><b>*</b></span>
															</li>
															<li>
																<label>Productos</label>
																<select name="idProducto" id="id_prod" required="required"  disabled="disabled">
																	
																</select>
																<span style="color: red;"><b>*</b></span>
															</li>
															<li>
																<div id="datosProd"></div>
															</li>
														</li>
													</ul>
												</li>
											</ul>
										</li>																		
									</form>
								</ul>
							</div>
						</section>
					</div>
				</div>
			</div>
		<?php endif; ?>	

<script type="text/javascript">
	$('document').ready(function(){
		$('.menu-pro').lksMenu();
	});
	
	$(function () {
	    $('#id_prove').change(function (a) {
	        if ($(this).val() != "") {
	            $('#id_prod').removeAttr('disabled');
	            $('#id_prod').load('index.php?url=viewProductProd&prove=' + this.options[this.selectedIndex].value );
	        }//else{
	        	// $('#id_prod').attr('disabled','disabled').val("");
	        	// $("#datosProd").css("display", "none");
	       	// }
	    });
	
	    if ($('#id_prove option:selected').val() != "") {
	        $('#id_prod').removeAttr('disabled');
	    }
	});
	
	$(function (a) {			
		$('#id_prod').change(function(a){
			if($('#id_prod').val() != ""){
				$('#datosProd').load('index.php?url=verInfoProd&IDproducto=' + this.options[this.selectedIndex].value);
	        }else{
		        $('#id_prod').removeAttr('disabled');
		        $("#datosProd").css("display", "none");
	        }
		});
	});
	
	$(function (e) {
		$('#formAgregarProducto').submit(function (e) {
			e.preventDefault()
			$('#productosAgregados').load('index.php?url=addProdVenta&' + $('#formAgregarProducto').serialize())
		})
	})
	
	$(function () {
		$('.borrarProducto').click(
			function () {
				formTransacion = this.form;
				$('#productosAgregados').load('index.php?url=deleteProdVenta&',$(formTransacion).serialize());
			}
		);
	});
</script>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
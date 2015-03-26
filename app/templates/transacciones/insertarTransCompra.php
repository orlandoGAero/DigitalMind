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
							<form action="index.php?url=continuarTransaccion" method="POST" id="formTransacion" target="_self">
								<li><a href="#">Datos Compra</a>
									<ul>
										<li>
											<span class="span">&nbsp;* Información requerida</span>
											<ul>
												<li>
													<div class="table-responsive">
														<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
															"id" para incluir los estilos a la tabla -->
												    	<table id="miTabla">
															<tr>
																<th>No. Compra</th>
																<td><?php echo $parametrosCompra2['noComprovanteC'] ?></td>
															</tr>
															<tr>
																<th>Proveedor</th>
																<td><?php echo $parametrosCompra2['nomProveedor'] ?></td>
															</tr>
															<tr>
																<th>Fecha</th>
															</tr>
															<tr>
																<th>Hora</th>
															</tr>
														</table>
												<li>
													<label>Productos</label>
													<select name="idProducto" required="required" >
														<option value="" disabled="disabled">Seleccione producto</option>
														<?php foreach ($parametrosCompra2['productos'] as $proveedor) :?>
															<option value="<?php echo $proveedor['id_producto'] ?>"><?php echo $proveedor['nombre_producto'] ?></option>
														<?php endforeach; ?>
													</select>
													<span style="color: red;"><b>*</b></span>
												</li>
												<li>
													
												</li>
												<li>
													<label>Cantidad</label>
													<input type="text" name="cantProd"/>
													<span style="color: red;"><b>*</b></span>
												</li>
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
		
	</script>
	

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
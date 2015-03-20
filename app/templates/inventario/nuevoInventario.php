<?php ob_start() ?>
	
	<div class="col-lg-14">
		<!-- div de imagen -->
			<div align="left"><a href="index.php?url=Inventario" onclick="return confirm('¿Desea salir antes de guardar?');"><img src="images/leftarrow.png" title="Regresar"></a></div>

		<div class="panel-default"> <!--clase panel-->
			<h1>Nuevo Registro Inventario</h1>
			<div class="panel-heading" style="height:40px;">
				<span class="span">&nbsp;* Información requerida</span>
			</div>

			<div class="panel-body">
				<section id="principal">
					<div class="">
						<ul>
							<form action="index.php?url=NuevoRegistro" method="POST" name="forminv" id="forminv" target="_self">
								<li><b>Datos Inventario</b>
									<ul>
										<li>
											<input type="text" name="txt_idInv" />
											<li>
												<label for="lbl_Prov">Proveedor:</label>
												<select name="slt_Prov">
													<option selected="">Ingresa un proveedor...</option>
												</select>
											</li>

											<li>
												<label for="lbl_prod">Producto:</label>
												<select name="slt_Prod">
													<option selected="">Ingresa un producto ...</option>
												</select>
											</li>

											<li>
												<label for="lbl_nofact">No. Factura Compra:</label>
												<input type="text" name="txt_factura"/>
											</li>

											<li>
												<label for="lbl_precio">Precio Unitario:</label>
												<input type="text" name="txt_precio" />
											</li>

											<li>
												<label for="lbl_desc">Descuento:</label>
												<input type="text" name="txt_desc" />
											</li>

											<li>
												<label for="lbl_tcambio">Tipo de cambio USD:</label>
												<input type="text" name="txt_tcambio" />
											</li>

											<li>
												<label for="lbl_estado">Estado:</label>
												<input type="radio" name="rad_estado" value="nuevo"> Nuevo
												<input type="radio" name="rad_estado" value="usado"> Usado
											</li>

											<li>
												<label for="lbl_status">Status:</label>
												<input type="radio" name="rad_status" value="bueno"> Bueno
												<input type="radio" name="rad_status" value="regular"> Regular
												<input type="radio" name="rad_status" value="malo"> Malo
											</li>

											<li>
												<label for="lbl_ubic">Ubicaci&oacute;n:</label>
												<input type="radio" name="rad_ubic" value="bodega"> Bodega
												<input type="radio" name="rad_ubic" value="mostrador"> Mostrador
												<input type="radio" name="rad_ubic" value="oficina"> Oficina
												<input type="radio" name="rad_ubic" value="casa"> Casa
											</li>

											<li>
												<label for="lbl_color">Color:</label>
												<input type="color" name="col_color"/>
											</li>

											<li>
												<label for="lbl_ext">Existencia:</label>
												<input type="number" name="num_ext"/>
											</li>
										</li>
									</ul>
								</li>
							</form>
						</ul>
					</div> <!-- -->
				</section> <!-- fin de seccion principal -->
			</div> <!-- fin de div panel-body -->
		</div> <!-- fin de div panel-default -->
	</div> <!-- fin de div col-lg-14 -->

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?> 
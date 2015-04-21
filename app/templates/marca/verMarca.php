<?php ob_start() ?>
	<!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" />

<body>
	<br>
	<div class="container">
    <div class="row">
		<h1><a href="index.php?url=listaMarca" title="Salir"><img src="images/salir.png" height="20px" /></a>Detalle Marca</h1>
		<div class="fondo"></div>
        <div class="col-md-6 col-md-offset-3">
			<ul class="nav-tabs" >
				<dd>
				<table class="table table-responsive"> 
					<tr><th>Clave</th><td><input type="text" name="idFam" value="<?php echo $lisM['id_marca']?>"readonly class="form-control"/></td></tr>
					<tr><th>Nombre</th><td><input type="text" name="nombre_fam" value="<?php echo $lisM['nombre_marca']?>" readonly class="form-control"/></td></tr>
					<tr><th>Estatus</th><td>
					 		<?php if ($lisM['activo'] =='Si'){
								/*echo"Si <input type = 'radio' name = 'activo'checked value='Si' readonly/>
								No <input type = 'radio' name = 'activo' value='No'/></td></tr>";*/
								echo"<input type='text' name='activo' value='Activo' class='form-control' readonly/></td></tr>";
							}else{
								/*echo"Si <input type = 'radio' name = 'activo' value='Si'/>
								No <input type = 'radio' name = 'activo' checked value='No'/></td></tr>";*/
								echo"<input type='text' name='activo' value='Inactivo' class='form-control' readonly/></td></tr>";
							}
					 		?>
					 		</table>
									</td>
								</tr>
							</table>
					 	<br>
					</dd>
				</ul>
			</div>
		</div>
	</div>
</body>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

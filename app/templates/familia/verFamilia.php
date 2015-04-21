<?php ob_start() ?>
		<link rel="stylesheet" href="css/estilos.css" />
	 <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" />

<body>
	
<br>

<div class="container">
    <div class="row">
		<h1><a href="index.php?url=listaFam" title="Salir"><img src="images/salir.png" height="20px" /></a>Detalle Familia</h1>
		<div class="fondo"></div>
        <div class="col-md-6 col-md-offset-3">
			<ul class="nav-tabs" >
				<dd>
				<table class="table table-responsive">      
					<tr><th>Clave</th><td><input type="text" name="idFam" value="<?php echo $lisFam['id_fam']?>"readonly class="form-control"/></td></tr>
					<tr><th>Nombre</th><td><input type="text" name="nombre_fam" value="<?php echo $lisFam['nombre_fam']?>" class="form-control" readonly /></td></tr>
					<tr><th>Estatus</th><td><!--<input type="text" name="nombre_fam" value="<?php echo $lisFam['nombre_fam']?>" class="form-control" readonly />-->
					 		<?php if ($lisFam['activo'] =='Si'){
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
					 	<br>
					</dd>
				</ul>
			</div>
		</div>
	</div>
</body>


<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
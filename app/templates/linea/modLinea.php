<?php ob_start() ?>
	<?php if (isset($Linea['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $Linea['mensaje'] ?></span></b>
	<?php endif; ?>

<!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" />

<div class="container">
    <div class="row">
		<h1><a href="index.php?url=listaLinea" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a>Modificar Linea</h1>
		<div class="fondo"></div>
        	<div class="col-md-6 col-md-offset-3">
        		<ul class="nav-tabs" >
				<dd>
			<!---Creamos el formulario-->
				<?php echo" <form action='index.php?url=verLineaMod&id_linea=".$obtenerLinea['id_linea']."' method='POST' id='formModF' target='_self' >"; ?>
						<label>Clave</label><br><input type="text" name="id_linea" value="<?php echo $obtenerLinea['id_linea']?>"readonly class="form-control"/>
						<label>Nombre</label><br><input type="text" name="nombre_linea" value="<?php echo $obtenerLinea['nombre_linea']?>" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" />
						<label><b>Activo<b></label><br>
						<?php if ($obtenerLinea['activo'] =='Si'){
								echo"Si <input type = 'radio' name = 'activo'checked value='Si'/>
								No <input type = 'radio' name = 'activo' value='No'/></td></tr>";
							}else{
								echo"Si <input type = 'radio' name = 'activo' value='Si'/>
								No <input type = 'radio' name = 'activo' checked value='No'/></td></tr>";
							}
					 		?>	
				<br>
				<input class='boton2' value='Editar' type='submit'>
					<br></form>
				</table>
			</div>
		</div>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

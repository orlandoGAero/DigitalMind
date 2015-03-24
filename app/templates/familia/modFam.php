<?php ob_start() ?>
	<?php if (isset($Familia['mensaje'])) :?>
		<b><span style="color: red;"><?php echo $Familia['mensaje'] ?></span></b>
	<?php endif; ?>

<!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" />

<div class="container">
    <div class="row">
		<h1><a href="index.php?url=listaFam" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a>Modificar Familia</h1>
		<div class="fondo"></div>
        	<div class="col-md-6 col-md-offset-3">
        		<ul class="nav-tabs" >
				<dd>
				<!---Creamos el formulario-->
				<?php echo" <form action='index.php?url=verFamMod&id_fam=".$obtenerFamilia['id_fam']."' method='POST' id='formModF' target='_self' >"; ?>
							<tr><th>Clave</th><td><input type="text" name="id_fam" value="<?php echo $obtenerFamilia['id_fam']?>"readonly class="form-control"/></td></tr>
							<tr><th>Nombre</th><td><input type="text" name="nombre_fam" value="<?php echo $obtenerFamilia['nombre_fam']?>" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" /></td></tr>
							<tr><th>Activo</th><br>
						 		<?php if ($obtenerFamilia['activo'] =='Si'){
									echo"<td>Si <input type = 'radio' name = 'activo'checked value='Si'/>
									No <input type = 'radio' name = 'activo' value='No'/></td></tr>";
								}else{
									echo"<td>Si <input type = 'radio' name = 'activo' value='Si'/>
									No <input type = 'radio' name = 'activo' checked value='No'/></td></tr>";
								}
						 		?>	<br>	
						<tr><th colspan="2"><input class='boton2' value='Editar' type='submit'></th></tr>
					<br></form>
				</table>
			</div>
		</div>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
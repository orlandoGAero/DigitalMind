<!-- <?php ob_start() ?>

	<link rel="stylesheet" href="css/estilos.css" />
	<script type="text/javascript" src="js/jquery.lksMenu.js"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
	</script>
	
	<h1><a href="index.php?url=listContact" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" width="20px" height="20px" /></a>Nuevo Contacto</h1>
	<div class="menu-pro">
		<ul>
			<li><a href="#">Datos Contacto</a>
				<ul>
					<li>
						
					</li>
				</ul>
			</li>
			<li><a href="#" >Datos Dirección Física</a>
				<ul>
					<li>
						
					</li>
				</ul>
			</li>
		
		</ul>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
<?php ob_start() ?>
	<link rel="stylesheet" href="css/estilos.css" />
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>

	<script>
        var a = jQuery.noConflict();
		a('document').ready(function(){
			a('.menu-pro').lksMenu();
		});
	</script>

	<script>
	<!--Script para la validación numerica en input="cp"-->
		function justNumbers(e)
		{
		var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum <= 8) || (keynum == 46))
		return true;
		 
		return /\d/.test(String.fromCharCode(keynum));
		}

	<!--Redirecciona el input="cp" a url-->
		function cpview(form)
		{
		  $('#id_cp').load('index.php?url=verinfoCP&cp=' + $('#formEDCliente').serialize()); 
                  $('#tablacp').load('index.php?url=verinfoCP2&cp=' + $('#formEDCliente').serialize());                     
		}


	<!--Validar solo letras-->
		function sololetras(){
		if (event.keyCode >45 && event.keyCode  <57) event.returnValue = false;
		}		

		function aMayusculas(field) {
	            field.value = field.value.toUpperCase()
		}
</script>

<!--COMBOS MÁGICOS-->
		<!--<link rel="stylesheet" href="js/chosen/css/stylesheet.css">-->
		<!--[if IE 8]><script src="js/es5.js"></script><![endif]-->
		<script src="js/chosen/js/jquery.js"></script>
        <script src="js/chosen/js/selectize.js"></script>
		<script src="js/chosen/js/index.js"></script>
	

</head>

<body>
	<div class="col-lg-14">
        <div class="panel panel-default">
	<h1><a href="index.php?url=listaCliente" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a>Editar Cliente</h1>
        <div class="panel-heading">    </div>
    <div class="panel-body">	
		<section id="principal">
	
	<div class="menu-pro">
		<ul>
			<li><a href="#"><b>Datos Cliente</b></a>
				<ul>
					<li>
					<?php echo" <form action='index.php?url=modCl&id_cli=".$obtenerCliente['id_cliente']."' method='POST' id='formCliente' target='_self' >"; ?>
						<table class="nuevo-pro" border="0">
							<tr><th>Clave_C</th><td><input type="text" name="id_cli" value="<?php echo $obtenerCliente['id_cliente']?>" readonly class="form-control"/></td></tr>
							<tr><th>Nombre</th><td><input type="text" name="nomb" value="<?php echo $obtenerCliente['nombre']?>" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|"  onChange="aMayusculas(this)" class="form-control"/></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
							<tr><th>Teléfono Móvil</th><td><input type="text" value="<?php echo $obtenerCliente['t_movil']?>" name="telMovil" required="required" maxlength="10" pattern="[0-9]{10}" class="form-control"/></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
							<tr><th>Teléfono Oficina</th><td><input type="text" value="<?php echo $obtenerCliente['t_oficina']?>" required="required" maxlength="10" pattern="[0-9]{10}" name="telOficina" class="form-control"/></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
							<tr><th>Teléfono Emergencia</th><td> <input type="text" value="<?php echo $obtenerCliente['t_emergencia']?>" maxlength="10" pattern="[0-9]{10}"  name="telEmergencia" class="form-control"/></td></tr>
							<tr><th>Ext.</th><td><input type="text" name="extension"  value="<?php echo $obtenerCliente['extension']?>" maxlength="3" pattern="[0-9]{3}"class="form-control"/></td></tr>
							<tr><th>Página web</th><td><input type="url" name="dirWeb" value="<?php echo $obtenerCliente['direccion_web']?>" class="form-control"/> </td> </tr>
		                    <tr><th>Categoría</th><td>
		                    <select name='categoria' class="form-control">
							<?php if($obtenerCliente['categoria'] != "") :?>
							<option value="<?php echo $obtenerCliente['id_categoria'] ?>"><?php echo $obtenerCliente['categoria'] ?></option>
							<?php else :?>
							<option value='0'>Seleccione una Opción</option>
							<?php endif; ?>
								<?php foreach ($obtenerDatosCatego['categoria'] as $catP) : ?>
							<option required='required' value="<?php echo $catP['id_categoria'] ?>"> <?php echo $catP['categoria'] ?> </option> 
							<?php endforeach; ?>
							</select></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>

							<tr><th>Activo</th><td>
					 		<?php if ($obtenerCliente['activo'] =='Si'){
								echo"Si <input type = 'radio' name = 'activo'checked value='Si'/>
								No <input type = 'radio' name = 'activo' value='No'/>";
							}else{
								echo"Si <input type = 'radio' name = 'activo' value='Si'/>
								No <input type = 'radio' name = 'activo' checked value='No'/>";
							}
					 		?>		
					 		</td><td><span class="span"><b>&nbsp;*</b></span></td></tr>	
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th>Clave</th><td><input type="text" id="id_datFiscal" name="id_datFiscal" value="<?php echo $obtenerCliente['id_datFiscal']?>" readonly /></td></tr>	
							<tr><th>Razón Social</th><td><input type="text" id="razon_social" name="razon_social" value="<?php echo $obtenerCliente['razon_social']?>" required onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
							<tr><th>RFC</th><td><input type="text" id="RFC" name="rfc" value="<?php echo $obtenerCliente['rfc']?>"required onChange="aMayusculas(this)" maxlength="13"/></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>	
							<tr> 
							<th>Municipio:</th>
							<td>   										    
							<select id="municipios2" name="municipios2" required class="demo-default" placeholder="Selecciona tú municipio...">										
							<?php if($obtenerCliente['estado'] != "0") :?>
							<option value="<?php echo $obtenerCliente['id_estado'] ?>"><?php echo $obtenerCliente['estado'] ?></option>
							<?php else :?>
							<option value='0'>Seleccione una Opción</option>
							<?php endif; ?>
								<?php foreach ($obtenerEstadosUpdate['estados'] as $state) : ?>
							<option required='required' value="<?php echo $state['id_estado'] ?>"> <?php echo $state['estado'] ?> </option> 
							<?php endforeach; ?>
							</select></td></tr>
						
						
						</table>

					</li>
				</ul>
			</li>

			
			<br>
 		  <button type="submit" class="boton2"><strong>Guardar</strong></button>
        </td></tr>          
	</form>
	</div>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>

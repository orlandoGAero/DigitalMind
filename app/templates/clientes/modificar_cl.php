<?php ob_start() ?>
	<link rel="stylesheet" href="css/estilos.css" />
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
	</script>

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
					<form action="--------" name="neo" class="cmxform" method="post" >
						<table class="nuevo-pro">
							<tr><th>Clave_C</th><td><input type="text" name="cv_cliente" value=""readonly /></td></tr>
							<tr><th>Nombre</th><td><input type="text" name="nomb" value="------"required /></td></tr>
							<tr><th>Fecha Alta</th><td><input type="text" name="f_alta" value="------"required  /></td></tr>
						</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th>Clave</th><td><input type="text" id="id_datFiscal" name="id_datFiscal" value="------"readonly /><td></td></td></tr>
							<tr><th>Razón Social</th><td><input type="text" id="razon_social" name="razon_social" value="------"required /></td><td></td></tr>
							<tr><th>RFC</th><td><input type="text" id="RFC" name="RFC" value="------"required /></td><td></td></tr>
							<tr><th>Tipo</th><td><input type="text" id="tipo" name="tipo" value="------"required /></td><td></td></tr>							
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Dirección Física</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							
							<tr><th></th><td><input type="text"  name="id_direccion" value="------" readonly /></td></tr>
							<tr><th>Código P.</th><td><input type="text" id="cp" name="cp" value="------"required /></td></tr>
							<tr><th>Municipio</th><td><input type="text" id="muni" name="muni" value="------"required /></td></tr>
							<tr><th>Localidad</th><td><input type="text" id="localidad" name="localidad" value="------"required /></td></tr>
							<tr><th>Estado</th><td><input type="text" id="estado" name="estado" value="------"required /></td></tr>
							<tr><th>Calle</th><td><input type="text" id="Calle" name="Calle" value="------"required /></td></tr>
							<tr><th>No. Ext</th><td><input type="text" id="Num_Ext" name="Num_Ext" value="------"required /></td></tr>
							<tr><th>No. Int</th><td><input type="text" id="Num_Int" name="Num_Int" value="------"required /></td></tr>
							<tr><th>Colonia</th><td><input type="text" id="Colonia" name="Colonia" value="------"required /></td></tr>
							<tr><th>Referencia</th><td><input type="text" id="Referencia" name="Referencia" value="------"required /></td></tr>
							<tr><th>GPS Ubicación</th><td><input type="text" id="GPS_Ubicacion" name="GPS_Ubicacion" required /></td></tr>
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Contacto</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							
							<tr><th></th><td><input type="text"  name="id_direccion" value="------" readonly /></td></tr>
							<tr><th>Nombre</th><td><input type="text" id="cp" name="cp" value="------"required /></td></tr>
							<tr><th>A.Paterno</th><td><input type="text" id="muni" name="muni" value="------"required /></td></tr>
							<tr><th>A.Materno</th><td><input type="text" id="localidad" name="localidad" value="------"required /></td></tr>
							<tr><th>Área</th><td><input type="text" id="estado" name="estado" value="------"required /></td></tr>
							<tr><th>Correo Inst.</th><td><input type="text" id="Calle" name="Calle" value="------"required /></td></tr>
							<tr><th>Movil</th><td><input type="text" id="Num_Ext" name="Num_Ext" value="------"required /></td></tr>
							<tr><th>Tel.Oficina</th><td><input type="text" id="Num_Int" name="Num_Int" value="------"required /></td></tr>
							
						</table>
					</li>
				</ul>
			</li>
<div class='table-responsive'>
			<li><a href="#"><b>Datos Bancarios</b></a>
				<ul>
					<li>
						<table class="nuevo-pro ">
							<tr><th>Clave</th><td><input type="text" name="id_bancarios" value="---------" readonly /></td></tr>
							<tr><th>Nombre Banco</th><td><input type="text" name="Nombre_Banco"value="------"required /></td></tr>
							<tr><th>Sucursal</th><td><input type="text" name="Sucursal" value="------"required /></td></tr>
							<tr><th>Titular</th><td><input type="text" name="Titular" value="------"required /></td></tr>
							<tr><th>No. Cuenta</th><td><input type="text" name="No_Cuenta" value="------"required /></td></tr>
							<tr><th>Clave Interbancaria</th><td><input type="text" name="No_ClaveInterbancaria" value="------"required /></td></tr>
							<tr><th>Tipo</th><td><input type="text" name="tipoC" value="------"required /></td></tr>
						</table>
					</li>
				</ul>
			</li>
					<input type="button"class="boton2" value="Editar">
					</form>
	</div>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
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
		<h1><a href="index.php?url=listaCliente" title="Salir"><img src="images/salir.png" height="20px" /></a>Detalle Cliente</h1>
        <div class="panel-heading">    </div>
    <div class="panel-body">	
		<section id="principal">
	<div class="menu-pro">
		<ul>
			<li><a href="#"><b>Datos Cliente</b></a>
				<ul>
					<li>
					<form action="mysqlinsert.php" name="neo" class="cmxform" method="post" >
						<table class="nuevo-pro">
							<tr><th width="50%">Clave_C</th><td><input type="text" name="cv_cliente" value="<?php echo $lisCliente['id_cliente']?>"readonly class="form-control"/></td></tr>
							<tr><th>Nombre</th><td><input type="text" name="nomb" value="<?php echo $lisCliente['nombre']?>"readonly class="form-control"/></td></tr>
							<tr><th>Fecha Alta</th><td><input type="text" name="f_alta" value="<?php echo $lisCliente['fecha_alta']?>" readonly class="form-control"/></td></tr>
						</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th width="50%">Clave</th><td><input type="text" name="id_datFiscal" value="<?php echo $lisCliente['id_datFiscal']?>"readonly class="form-control"/><td></td></td></tr>
							<tr><th>Razón Social</th><td><input type="text" name="razon_social" value="<?php echo $lisCliente['razon_social']?>"readonly class="form-control"/></td><td></td></tr>
							<tr><th>RFC</th><td><input type="text" name="RFC" value="<?php echo $lisCliente['rfc']?>"readonly class="form-control"/></td><td></td></tr>
							<tr><th>Tipo</th><td><input type="text" name="tipo" value="<?php echo $lisCliente['tipo']?>"readonly class="form-control"/></td><td></td></tr>							
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Dirección Física</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							
							<tr><th width="50%">Clave</th><td><input type="text"  name="id_direccion" value="<?php echo $lisCliente['id_direccion']?>" readonly class="form-control"/></td></tr>
							<tr><th>Código P.</th><td><input type="text" id="cp" name="cp" value="<?php echo $lisCliente['codigoP']?>"readonly class="form-control"/></td></tr>
							<tr><th>Municipio</th><td><input type="text" id="muni" name="muni" value="<?php echo $lisCliente['municipio']?>"readonly class="form-control"/></td></tr>
							<tr><th>Localidad</th><td><input type="text" id="localidad" name="localidad"value="<?php echo $lisCliente['localidad']?>"readonly class="form-control"/></td></tr>
							<tr><th>Estado</th><td><input type="text" id="estado" name="estado" value="<?php echo $lisCliente['estado']?>"readonly class="form-control"/></td></tr>
							<tr><th>Calle</th><td><input type="text" id="Calle" name="Calle" value="<?php echo $lisCliente['calle']?>"readonly class="form-control"/></td></tr>
							<tr><th>No. Ext</th><td><input type="text" id="Num_Ext" name="Num_Ext" value="<?php echo $lisCliente['num_ext']?>"readonly class="form-control"/></td></tr>
							<tr><th>No. Int</th><td><input type="text" id="Num_Int" name="Num_Int" value="<?php echo $lisCliente['num_int']?>"readonly class="form-control"/></td></tr>
							<tr><th>Colonia</th><td><input type="text" id="Colonia" name="Colonia" value="<?php echo $lisCliente['colonia']?>"readonly class="form-control"/></td></tr>
							<tr><th>Referencia</th><td><input type="text" id="Referencia" name="Referencia" value="<?php echo $lisCliente['referencia']?>"readonly class="form-control"/></td></tr>
							<tr><th>GPS Ubicación</th><td><input type="text" id="GPS_Ubicacion" name="GPS_Ubicacion" readonly class="form-control" /></td></tr>
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Contacto</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							
							<tr><th width="50%">Clave</th><td><input type="text"  name="id_direccion" value="<?php echo $lisCliente['id_contacto']?>" readonly class="form-control"/></td></tr>
							<tr><th>Nombre</th><td><input type="text" id="cp" name="cp" value="<?php echo $lisCliente['nombreCon']?>"readonly class="form-control"/></td></tr>
							<tr><th>A.Paterno</th><td><input type="text" id="muni" name="muni" value="<?php echo $lisCliente['ap_paterno']?>"readonly class="form-control"/></td></tr>
							<tr><th>A.Materno</th><td><input type="text" id="localidad" name="localidad"value="<?php echo $lisCliente['ap_materno']?>"readonly class="form-control"/></td></tr>
							<tr><th>Área</th><td><input type="text" id="estado" name="estado" value="<?php echo $lisCliente['nombre_area']?>"readonly class="form-control"/></td></tr>
							<tr><th>Correo Inst.</th><td><input type="text" id="Calle" name="Calle" value="<?php echo $lisCliente['correo_instu']?>"readonly class="form-control"/></td></tr>
							<tr><th>Movil</th><td><input type="text" id="Num_Ext" name="Num_Ext" value="<?php echo $lisCliente['movil']?>"readonly class="form-control"/></td></tr>
							<tr><th>Tel.Oficina</th><td><input type="text" id="Num_Int" name="Num_Int" value="<?php echo $lisCliente['tel_oficina']?>"readonly class="form-control"/></td></tr>
							
						</table>
					</li>
				</ul>
			</li>
<div class='table-responsive'>
			<li><a href="#"><b>Datos Bancarios</b></a>
				<ul>
					<li>
						<table class="nuevo-pro ">
							<tr><th width="50%">Clave</th><td><input type="text" name="id_bancarios" value="<?php echo $lisCliente['id_datBank']?>"readonly class="form-control"/></td></tr>
							<tr><th>Nombre Banco</th><td><input type="text" name="Nombre_Banco" value="<?php echo $lisCliente['nombre_banco']?>"readonly class="form-control"/></td></tr>
							<tr><th>Sucursal</th><td><input type="text" name="Sucursal" value="<?php echo $lisCliente['sucursal']?>"readonly class="form-control"/></td></tr>
							<tr><th>Titular</th><td><input type="text" name="Titular" value="<?php echo $lisCliente['titular']?>"readonly class="form-control"/></td></tr>
							<tr><th>No. Cuenta</th><td><input type="text" name="No_Cuenta" value="<?php echo $lisCliente['no_cuenta']?>"readonly class="form-control"/></td></tr>
							<tr><th>Clave Interbancaria</th><td><input type="text" name="No_ClaveInterbancaria" value="<?php echo $lisCliente['no_cuenta_interbancario']?>"readonly class="form-control"/></td></tr>
							<tr><th>Tipo</th><td><input type="text" name="tipoC" value="<?php echo $lisCliente['tipo_cuenta']?>"readonly class="form-control"/></td></tr>
						</table>
					</li>
				</ul>
			</li>
					</form>
	</div>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
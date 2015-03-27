<?php ob_start() ?>

	<link rel="stylesheet" href="css/estilos.css" />

 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
	</script>

<!--Scripts para el funcionamiento de la ventana: Ventana emergente para agregar la direccion de clientes-->
	<script>
		!window.jQuery && document.write('<script src="js/fancybox/jquery-1.4.3.min.js"><\/script>');
	</script>


	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="css/fancybox/fancybox.css" media="screen" />
<!--  Script para las ventanas emergentes -->

<script type="text/javascript">
		$('document').ready(function() {


			$('#various2').fancybox();
	});
		$('document').ready(function() {


			$('#various1').fancybox();
	});
	</script>
<!--Fin-->

<!--Script para el CP en direccion_cliente: en la ventana emeregente en tiempo real-->
			<script >
			$(function (e) {
				$('#frmdocp').submit(function (e) {
					e.preventDefault()
					$('#tablacp').load('../app/templates/cp_view.php?' + $('#frmdocp').serialize())
				})
			})
            
			function cpview(form)
			{
		       $('#tablacp').load('../app/templates/clientes/cp_view.php?' + $('#frmdocp').serialize())    
			}
                
                
            $(function (e) {
				$('#frmdodir').submit(function (e) {
					e.preventDefault()
					$('#tablacp').load('../app/templates/clientes/cp_view2.php?' + $('#frmdodir').serialize())
				})
			})
            
                
			</script>

<!--FORM_contacto-->
			<script type="text/javascript">		
				$('document').ready(function() {
					$('#newC').fancybox();
				});
			</script>
	
			<script >
			$(function (e) {
				$('#frmdoC').submit(function (e) {
					e.preventDefault()
					$('#nContacto').load('../app/templates/clientes/new_contacto.php?' + $('#frmdoC').serialize())
				})
			})
	</script> 	<!--Fin-->


</head>

<body>

<div class="col-lg-14">
        <div class="panel panel-default">
	<h1><a href="index.php?url=listaCliente" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a>Nuevo Cliente</h1>
        <div class="panel-heading">    </div>
    <div class="panel-body">	
		<section id="principal">
	<div class="menu-pro">
		<ul>
		<form action="index.php?url=agregarCl" method="POST" name="formCliente">
			<li><a href="#"><b>Datos Cliente</b></a>
				<ul>
					<li>
					<form action="index.php?url=agregarCl" method="post">
						<table class="nuevo-pro">
							<tr><th><label>Clave</label></th><td><input type="text" name="idCliente" value="<?php echo $Clientes['idCli']?>" readonly class="form-control"/></td></tr>
							<tr><th><label><b>Nombre</b></label></th><td><input type="text" name="nomb"  value="<?php echo $Clientes['nombre']?>" class="form-control" required placeholder="KRISMAR" /></td></tr>
							<tr><th><label><b>Fecha Alta</b></label></th><td><input type="date" name="f_alta" value="<?php echo date("Y-m-d"); ?>" required class="form-control" /></td></tr>
							<tr><th><label><b>Activo<b></label></th><td>
								Si <input type = 'radio' name = 'activo' value = 'Si' required="required" />
								No <input type = 'radio' name = 'activo' value = 'No'  required="required" /></td></tr>                                         
									
						</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th><label>Clave</label></th><td><input type="text" name="idDatF" value="<?php echo $Clientes['idDatF']?>"readonly class="form-control"/></td></tr>
							<tr><th><label><b>Razón Social</b></label></th><td><input type="text" name="razonS" value="<?php echo $Clientes['razonS']?>" placeholder="GRUPO RSA S.A. DE C.V." class="form-control" required/></td><td></td></tr>
							<tr><th><label><b>RFC</b></label></th><td><input type="text" name="rfc" maxlength="15" placeholder="VECJ880326 XXXX" value="<?php echo $Clientes['rfc']?>" class="form-control" required pattern="[a-zA-Z0-9]+"/></td><td></td></tr>
							<tr><th><label><b>Tipo Razón</b></label></th><td><select name="tipoRason_Social" class="form-control">
							<?php  
									$obtenerTipo = array(
										'tRazSocial' => model::obtieneTrazon(),
									);
									echo"<option selected>";
									foreach ($obtenerTipo['tRazSocial'] as $tipoR) {
										echo"<option value = ".$tipoR['id_tipo_ra']." >".$tipoR['tipo']."</option>";
									}
							?>
								</select></td><td></td></tr>
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Dirección Física</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr class="direccion"><th></th><td>
								<table>
									<tr>
										<tr><td><input type="hidden"  name="idAddress" value="<?php echo $Clientes['idDir'] ?>" readonly /></td></tr>
										<td width="220px"></td>
										<td width="210px"></td>
										<td width="210px">
										<td width="225px">
                                            <a id='various1' href="#dir" title="Nueva Dirección" ><img src="images/new_dir.png"/>Nueva </a></td>
										</tr>
								</table>
							</td></tr></table>               
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Contacto</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr class="direccion"><th></th><td>
								<table>
										<td width="253px"></td>
										<td width="253px"></td>
										<td width="220px"><a id='newC' href="#nContacto" title="Nueva Contacto"><img src="images/new_cont.png" alt="Nuevo Contacto" title="Nuevo Contacto" /> Nuevo Contacto</a></td>
										<td width="235px"><a href=""><img src="images/buscar.png" alt="Agregar Contacto" title="Agregar Contacto" /> Agregar</a></td>
									</tr>
								</table>
							
						</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Bancarios</b></a>
				<ul>
					<li>
						<table class="nuevo-pro ">
							<tr><th></th><td><input type="hidden" name="idDBank" value="<?php echo $Clientes['idDBank']?>"required class="form-control"/></td></tr>
							<tr><th><label><b>Banco</b></label></th><td><select name="nombreB" class="form-control">
							<?php  
									$Nombre_Banco = array(
										'nomBanco' => model::obtieneBanco(),
									);
									echo"<option selected>";
									foreach ($Nombre_Banco['nomBanco'] as $banco) {
										echo"<option value = ".$banco['id_banco']." >".$banco['nombre_banco']."</option>";
									}
							?>
								</select></td><td></td></tr>
							<tr><th><label><b>Sucursal</b></label></th><td><input type="text" name="sucursal" class="form-control"/></td></tr>
							<tr><th><label><b>Titular</b></label></th><td><input type="text" name="titular" class="form-control"/></td></tr>
							<tr><th><label><b>No. Cuenta</b></label></th><td><input type="text" name="n_cuenta" class="form-control"/></td></tr>
							<tr><th><label><b>Cv.Interbancaria</b></label></th><td><input type="text" name="n_claveInterbancaria" maxlength="18" class="form-control"/></td></tr>
							<tr><th><label><b>Tipo Cuenta</b></label></th><td><select id="tipo_c" name="tipo_c" class="form-control">
							<?php  
									$Tipo_cuenta = array(
										'tipoC' => model::obtieneTipoC(),
									);
									echo"<option selected>";
									foreach ($Tipo_cuenta['tipoC'] as $tipoC) {
										echo"<option value = ".$tipoC['id_tipo_cuenta']." >".$tipoC['tipo_cuenta']."</option>";

									}
							?>
								</select></td><td></td></tr>
						</table><br>
					</li>
				</ul>
			</li>
		
						<input type="submit" class="boton2" value="Guardar" name="Guardar" />
					</form>
		</div>
	</section>
	</div>
	</div>
	</div>
<!--  ventana emergente-->
<div style="display: none;">
	<div id="dir" style="width:600px;height:350px;overflow:auto;">
<!-- Aqui va el contenido de la ventana-->

<center>

    	<form action="#" method="POST" name="frmdocp" id="frmdocp" target="_self">
            <table  class="nuevo-pro ">

    		<?php
                 $id_dir = model::idDir(['id_direccion']);
			?>
            
			<tr><th>Clave</th><td><input type="number"  name="id_dir" value="<?php echo $id_dir ?>" readonly /></td></tr>
            
            <tr><td>CP:</td><td><input name="cp" type="text" minlength="4" maxlength="5" onKeyUp="cpview(this.form)" required /></td></tr>
          
</table>	

    </form>

			<div id='tablacp'>
        

        </div>
        </center>
        
	</div>
</div>

<!--  ventana emergente-->

							<div style="display: none;">
								<div id="nContacto" style="width:720px;height:450px;overflow:auto;">
							<!-- Aqui va el contenido de la ventana-->

							<form action="guardar.php" method="post" id="frmdoC" name="frmdoC"><br>
				<table>
					<tr>
						<td>
							<table class="nuevo">
								<tr><th></th><td><input type="hidden" name="id_contacto" required disabled /></td></tr>
								<tr><th width="140px">Nombre</th><td><input type="text" name="nombre" autofocus required /></td><th>Twitter</th><td><input type="text" name="twitter" /></td></tr>
								<tr><th>A. Paterno</th><td><input type="text" name="a_paterno" required /></td><th>Skype</th><td><input type="text" name="skype" placeholder="skype" /></td></tr>
								<tr><th>A. Materno</th><td><input type="text" name="a_materno" required /></td><th>Web</th><td><input type="url" name="direccion_web" placeholder="http://dominio.com.mx" /></td></tr>
								<tr><th>Area Contacto</th><td><input type="text" name="areaC"/></td></th>
								<?php
                					 $id_dir = model::incrementoDir(['id_direccion']);
								?>

								<th>Clave</th><td><input type="text"  name="idd" value="<?php echo $id_dir ?>" readonly /></td></tr>
								<tr><th>Fecha Alta</th><td><input type="date" name="Fecha_Alta"value="<?php echo date("Y-m-d"); ?>" class="form-control" readonly /></td><th>CP:</td><td><input name="cp" type="number"  required maxlength="6" onKeyUp="cpview(this.form)" /></td></tr>
								<tr><th>Móvil</th><td><input type="tel" name="movil" maxlength="12" /></td></th></td><th>Facebook</th><td><input type="text" name="facebook" /></td></tr>
								<tr><th>Tel. Oficina</th><td><input type="tel" name="Tel_Oficina" maxlength="12" /></td><th></th><td></td></tr>									
								<tr><th>Tel. Emergencia</th><td><input type="tel" name="Tel_Emergencia" maxlength="12" /></td><th></th><td></td></tr>	
								<tr><th>Email Personal</th><td><input type="email" name="correo" placeholder="ejemplo@dominio.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" /></td><th></th><td></td></tr>	
								<tr><th>Email Institucional</th><td><input type="email" name="correo_inst" placeholder="ejemplo@dominio.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" /></td><th></th><td></td></tr>	
								<tr><th>Facebook</th><td><input type="text" name="facebook" /></td><th></th><td></td></tr>	
						
							</table>
						</td>
					</tr><br>
					<tr><td colspan="2"><input type="submit" class="btn primary" value="Guardar" name="Guardar" /></td></tr>
				</table>
			</form>	
					</center>
							        
								</div>
							</div>



<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>
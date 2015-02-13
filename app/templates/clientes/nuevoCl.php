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
							<tr><th></th><td><input type="hidden" name="idCliente" value="<?php echo $Clientes['idCli']?>"required class="form-control"/></td></tr>
							<tr><th><label><b>Nombre</b></label></th><td><input type="text" name="nomb"  value="<?php echo $Clientes['nombre']?>"required class="form-control"/></td></tr>
							<tr><th><label><b>Fecha Alta</b></label></th><td><input type="date" name="f_alta" value="<?php echo date("Y-m-d"); ?>" required class="form-control" /></td></tr>
							<tr><th><label><b>Activo<b></label></th><td>
								Si <input type = 'radio' name = 'activo' value = 'Si'  />
								No <input type = 'radio' name = 'activo' value = 'No' /></td></tr>                                         
									
						</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th></th><td><input type="hidden" name="idDatF" value="<?php echo $Clientes['idDatF']?>"required class="form-control"/></td></tr>
							<tr><th><label><b>Razón Social</b></label></th><td><input type="text" name="razonS" value="<?php echo $Clientes['razonS']?>" class="form-control"/></td><td></td></tr>
							<tr><th><label><b>RFC</b></label></th><td><input type="text" name="rfc" maxlength="15" placeholder="VECJ880326 XXXX" value="<?php echo $Clientes['rfc']?>" class="form-control"/></td><td></td></tr>
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
										<td width="220px"><a href=""><img src="images/new_cont.png" alt="Nuevo Contacto" title="Nuevo Contacto" /> Nuevo Contacto</a></td>
										<td width="235px"><a href=""><img src="images/buscar.png" alt="Agregar Contacto" title="Agregar Contacto" /> Agregar</a></td>
									</tr>
								</table>
							</td></tr>
							</td></tr>
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
                 $id_dir = model::incrementoDir(['id_direccion']);
			?>
            
			<tr><th>Clave</th><td><input type="text"  name="id_dir" value="<?php echo $id_dir ?>" readonly /></td></tr>
            
            <tr><td>CP:</td><td><input name="cp" type="text" maxlength="6" onKeyUp="cpview(this.form)" /></td></tr>
          
</table>	

    </form>

			<div id='tablacp'>
        

        </div>
        </center>
        
	</div>
</div>


<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>
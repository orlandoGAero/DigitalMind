<?php ob_start() ?>
	<!-- css Formulario Listas Desplegables-->
	<link rel="stylesheet" href="css/estilos.css" />

	<!-- JS Formulario Listas Desplegables -->
 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js; ?>"></script>

	<!--Script listas desplegables-->
	<script>
                var sam = jQuery.noConflict();
		sam('document').ready(function(){
			sam('.menu-pro').lksMenu();
		});
	</script>
	

	<script>
/*	<!--Script para la validación numerica en input="cp"-->*/
		function justNumbers(e)
		{
		var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum <= 8) || (keynum == 46))
		return true;
		return /\d/.test(String.fromCharCode(keynum));
		}
         
/*	<!--Validar solo letras-->*/
		function sololetras(){
		if (event.keyCode >45 && event.keyCode  <57) event.returnValue = false;
		}
        
   function aMayusculas(field) {
	            field.value = field.value.toUpperCase()
		}
		
	</script>




<?php
    //Script para cargar la primera vez la paginacion del contacto

    echo "
	<script type='text/javascript'>
        	sam('document').ready(function() 
				{
					 sam('#tabla_paginacion').load('index.php?url=paginacion_contacto&idcli=$idcli'); 
				});

			</script>";
?>
<!--Combos Buscadores mas pro(sam) :P-->
	<!--<link rel="stylesheet" href="js/chosen/css/stylesheet.css">
	<!--[if IE 8]><script src="js/es5.js"></script><![endif]-->
	<script src="js/chosen/js/jquery.js"></script>
    <script src="js/chosen/js/selectize.js"></script>
	<script src="js/chosen/js/index.js"></script>
<!-- TERMINAN LIRERIAS COMBOS MAGICOS SAM -->


<div class="col-lg-14">
	<div class="panel panel-default">
		<h1><!--><a href="index.php?url=listaCliente" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a><-->Nuevo Cliente Parte 2</h1>
			<div class="panel-heading"> <span class="span">* Información requerida</span><br> </div>
        
			<div class="panel-body">	
                
                


    <!--Panel datos Bancarios donde se recargara todo-->
<section id="principal">
		<div class="menu-pro">
            <ul>
            		<li><a href="#"><b>Datos Bancarios</b></a>
				<ul>
					<li>

<div id="datBancarios">          
<script type="text/javascript">
    /*Funcion para Agregar Datos Bancarios*/
    			sam(function (e) {
				sam('#formBancario').submit(function (e) {
					e.preventDefault()
					sam('#datBancarios').load('index.php?url=nuevoDB&div=1&' + $('#formBancario').serialize())

				})
			})
                
                /*Funcion para agrega Contactos Nuevos*/
        	sam(function (e) {
				sam('#frmdoCon').submit(function (e) {
					e.preventDefault()
					sam('#divContacto').load('index.php?url=nuevoContacto&' + $('#frmdoCon').serialize())

				})
			})    
</script>    
    
<form action="#" method="POST"  name="formBancario" id="formBancario" target="_self">
<table class="nuevo-pro ">
	<tr><th>Clave</th><td><input type="text" name="idDatBank"   value="<?php echo $idDatBank; ?>"readonly class="form-control"/></td></tr>
	
		<tr><th><label><b>Banco</b></label></th><td><?php echo"<select id='nombreB' name='nombreB' required class='form-control'>
          		 <option value='0'>Seleccione una Opción</option>";
					foreach($CargaCombo2 as $comboB): 										 
				echo "<option value=".$comboB['id_banco'].">". $comboB['nombre_banco']."</option>";
					endforeach; 
				echo "</select> </td></tr>";?>
				
		<tr><th><label><b>Sucursal</b></label></th><td><input type="text" name="sucursal" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" maxlength="30" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		<tr><th><label><b>Titular</b></label></th><td><input type="text" name="titular" class="form-control" required pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" maxlength="30" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		<tr><th><label><b>No. Cuenta</b></label></th><td><input type="text" name="n_cuenta" onkeypress='return justNumbers(event);' class="form-control" required="required" maxlength="4" /></td></tr>
		<tr><th width="50px"><label><b>C.Interbancaria</b></label></th><td><input type="text" name="n_claveInterbancaria" onkeypress='return justNumbers(event);' maxlength="4" class="form-control" required="required"/></td></tr>
		<tr><th><label><b>Tipo Cuenta</b></label></th><td><?php echo"<select name='tipo_c' class='form-control'>
		 <option value='0'>Seleccione una Opción</option>";
					foreach($CargaCombo3 as $comboTP): 										 
				echo "<option value=".$comboTP['id_tipo_cuenta'].">". $comboTP['tipo_cuenta']."</option>";
					endforeach; 
				echo "</select> </td></tr>";?>
		</table><br>
<input type="hidden" name="idCliente" value="<?php echo $idcli;?>">            
<input type="submit" class="boton2" value="Continuar" name="Guardar" />
            </form>
  </div>
    <div id="tabBancarios">
            
</div>
</li>
</ul>
</li>

	<li><a href="#"><b>Agregar un Nuevo Contacto</b></a>
						<ul>
							<li>

       <div id="divContacto">
           <!--Div Que contiene el Formulario de Contacto-->
    	<form action="#" method="POST" name="frmdoCon" id="frmdoCon" target="_self">           
     <table border="0" class="nuevo-pro">
<!--Id del Contacto-->
         <input type="hidden" name="idContact" value="<?php echo $idCon  ?>" readonly />
         <tr>
             <th>Nombre</th>
             <td><input type="text" name="nameContact" autofocus="autofocus" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></td>
         </tr>
         <tr>
             <th>Apellido Paterno</th>
             <td><input type="text" name="ApPContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></td>
         </tr>
         <tr>
             <th>Apellido Materno</th>
             <td><input type="text" name="ApMContact" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" /><span style="color: red;"><b>&nbsp;*</b></span></td>
         </tr>
         <tr>
             <th>Área</th>
             <td><input type="text" name="nameArea" autocomplete="off" required="required" maxlength="50" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|" onChange="aMayusculas(this)" /><span style="color: red;"><b>*</b></span></td>
         </tr>
          <tr>
             <th>Teléfono Móvil</th>
             <td><input type="text" id="tel" class="keysNumbers" name="telMovil" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" /><span style="color: red;"><b>&nbsp;*</b></span></td>
         </tr>                                   
         <tr>
             <td colspan="2"><input type="checkbox" name="whatsapp" value="Si"/> Utilizas <img src="images/whatsapp-icono.png" title="Whatsapp"/></td>
             <!--<td></td>-->
         </tr>												
         <tr>
             <th>Extensión</th>
             <td><input type="text" id="tel" class="keysNumbers" name="extC" autocomplete="off" required="required" maxlength="3" pattern="[0-9]{3}"  /><span style="color: red;"><b>*</b></span></td>
         </tr>
         <tr>
             <th>Teléfono Oficina</th>
             <td><input type="text" id="tel" class="keysNumbers" name="telOficina" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}"  /><span style="color: red;"><b>*</b></span></td>
         </tr>
         <tr>
             <th>Teléfono Emergencia</th>
             <td><input type="text" id="tel" class="keysNumbers" name="telEmergencia" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}"  /><span style="color: red;"><b>*</b></span></td>
         </tr>
         <tr>
             <th>Correo Personal</th>
             <td><input type="email" name="emailPersonal" autocomplete="off" required="required" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" /><span style="color: red;"><b>&nbsp;*</b></span></td>
         </tr>
         <tr>
             <th>Correo Institucional</th>
             <td><input type="email" name="emailInstitucional" autocomplete="off" maxlength="50" placeholder="nombre@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  /></td>
         </tr>
         <tr>
             <th>Facebook</th>
             <td><input type="text" name="redSocialF"  autocomplete="off" maxlength="20" pattern="^[a-z\d\.]{5,}$"/></td>
         </tr>
         <tr>
             <th>Twitter</th>
             <td><input type="text" name="redSocialT" autocomplete="off" maxlength="20" /></td>
         </tr>
         <tr>
             <th>Skype</th>
             <td><input type="text" name="redSocialS"  autocomplete="off" maxlength="20" /></td>
         </tr>
         <tr>
             <th>Página Web</th>
             <td><input type="url" name="webPage"  autocomplete="off" maxlength="30" placeholder="http://www.ejemplo.com" /></td>
         </tr>
         <tr>
		<td colspan="3"  BGCOLOR='#92C9DC'><b>Datos de Dirección</b></td>

         </tr>
         <tr>
		<th>Clave</th><td><input type="text" class="form-control" name="idDir" value="<?php echo     $idDir ; ?>" readonly /></td></tr>										
		<tr><th>Estado:</th>
		<td> 
        <select id="idEdo" name="idEdo" required class="demo-default" placeholder="Selecciona un Estado">
							<option value="">Selecciona un Estado</option>
           <?php                 
foreach($comboEstados as $codPost): 
 
echo "<option value=".$codPost['id_estado'].">". $codPost['estado']."</option>";

endforeach; ?>
						</select>
</td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
<tr>    
	<th>Municipio:</th>
<td>   										    
<select id="municipios" name="municipios" required class="demo-default" placeholder="Selecciona tú municipio...">
	<option value="">Selecciona tú municipio...</option>
</select>
</td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
<tr>    
<th>Localidad:</th>
<td>   										    
<select id="localidades" name="localidades" required class="demo-default" placeholder="Selecciona tú Localidad...">
<option value="">Selecciona tú Localidad...</option>
</select>
</td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
	<tr>    
	<th>Código Postal:</th>
<td>  										    
<input type="text" readonly name="id_cp" value="" id="id_cp">
</td></tr>
  </table>
											            
	<!--div con el resto del formulario de direccion-->			
	 <div id="visto" style="display:none;" style="visibility:hidden;">
<table class="nuevo-pro">					                  
<tr>
	<th colspan='2'><MARQUEE Behavior ='slide' BGCOLOR='#92C9DC' WIDTH='100%'>Completar Datos de Dirección</MARQUEE></th></tr>
	<tr>
			<th>Colonia</th>
			<td><input type='text'  name='colonia' class='form-control' required='required' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' placeholder='centro' maxlength='30' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		</tr>
		<tr>
			<th>Calle</th>
			<td><input type='text'  name='calle'required='required' class='form-control' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' placeholder='Nicolas Bravo' maxlength='30' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
		</tr>
		<tr>
			<th>Número Ext.</th>
			<td><input type='text'  name='numExt' required='required' class='form-control' onkeypress='return justNumbers(event);' placeholder='158' /></td>
		</tr>
		<tr>
			<th>Numero Int.</th>
			<td><input type='text'  name='numInt' required='required' class='form-control' onkeypress='return justNumbers(event);' placeholder='2'/></td>
		</tr>
		<tr>
	<th>Referencia</th>
	<td><input type='text'  name='ref'  class='form-control' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' maxlength='40'onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>

	</table>    
 </div>
    <!--Id del Cliente-->
<input type="hidden" name="idCliente" value="<?php echo $idcli;?>">
        <input type="submit" value="Guardar" onClick="parent.jQuery.fancybox.close();" class="boton2">				
                            </form>
     
                        
                        </div>

                            </li>
                        </ul>
                </li>
            </ul>
            
            

    </div>
                <div id="tabla_paginacion">
    
<!--Aqui cargan las tablas para asignar o eliminar contacto-->  

<?php
  echo  $idcli;
?>
    no esta cargando nada :(
    
    </div>        

                </section>

					<?php echo "<form action='index.php?url=validaformTwo&id_cli".$idcli."'method='POST'  name='formContacto' id='formContacto' target='_self'>" ?>
		                    
                                        
                                        
						<input type="submit" class="boton2" value="Continuar" name="Guardar" />
					</form>
</div>
</div>
        

                                
        

		      
								

<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

	<!--Script para direccion-->
		
		<script>
				$('#idEdo').selectize({
    onChange: function(value){

  
         select_city.clearOptions();
   

        
 $('#divmunicipios').load('index.php?url=verMunicipio&select=1&idEdo=' + value );
    }});
  
    
           $select_city = $('#municipios').selectize({
    valueField: 'municipio',
    labelField: 'municipio',
    searchField: 'municipio',
    create: false,
        onChange: function(value){

  
         select_locale.clearOptions();
       
   

        
 $('#divlocalidades').load('index.php?url=verLocalidad&select=1&idEdo=' + $('#frmdoCon').serialize());
    }   
           });

    select_city  = $select_city[0].selectize;        
            
select_city.disable();

            
$select_locale = $('#localidades').selectize({
    valueField: 'id_cp',
    labelField: 'localidad',
    searchField: 'localidad',
    create: false,
        onChange: function(value){

              
        $('#id_cp').val(value);
            
      $("#visto").show();

    }   
           
           });
            
select_locale  = $select_locale[0].selectize;        
            
select_locale.disable();
            
            
				</script>


<!--Aqui carga los scripts para llenar los select-->
<div id="divmunicipios">
<!--Aqui carga los scripts para llenar los select-->
</div>
<div id="divlocalidades">
    <!--Aqui carga los scripts para llenar los select-->
</div>

<!---------------------------------------------------------------------------------------------------------->

     </div>






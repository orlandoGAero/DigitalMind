<?php ob_start() ?>
	<!-- css Formulario Listas Desplegables-->
	<link rel="stylesheet" href="css/estilos.css" />

	<!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>

	<!--Script listas desplegables-->
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
		<h1><a href="index.php?url=listaCliente" title="regresar" onclick="return confirm('Desea salir antes de guardar?');"><img src="images/salir.png" height="20px" /></a>Nuevo Cliente</h1>
			<div class="panel-heading"> <span class="span">* Información requerida</span><br> </div>
			<div class="panel-body">	
				<section id="principal">
		<div class="menu-pro">
			<ul>
					<li><a href="#"><b>Datos Cliente</b></a>
						<ul>
							<li>
							<form action="index.php?url=addCliente" method="POST"  name="formCliente" id="formCliente" target="_self">
								<table class="nuevo-pro" width="70%">
									<tr><th><!--<label>Clave</label>--></th><td><input type="hidden" name="idCliente" value="<?php echo $Clientes['idCli']?>" readonly class="form-control"/></td></tr>
									<tr><th><label><b>Nombre</b></label></th><td><input type="text" name="nomb"  value="" class="form-control" required placeholder="KRISMAR" pattern="|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|"  onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									<tr><th><label><b>Teléfono Móvil</b></label></th> <td> <input type="text" onkeypress='return justNumbers(event);' name="telMovil" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}"class="form-control" onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									<tr><th><label><b>Teléfono Oficina</b></label></th> <td> <input type="text" onkeypress='return justNumbers(event);' name="telOficina" autocomplete="off" required="required" maxlength="10" pattern="[0-9]{10}" class="form-control" onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									<tr><th><label><b>Teléfono Emergencia</b></label></th> <td> <input type="text" onkeypress='return justNumbers(event);' name="telEmergencia" autocomplete="off" maxlength="10" pattern="[0-9]{10}" class="form-control"onChange="aMayusculas(this)" /></td></tr>
									<tr><th><label><b>Ext.</b></label></th> <td> <input type="text" name="extension"  onkeypress='return justNumbers(event);' autocomplete="off" maxlength="3" pattern="[0-9]{3}" class="form-control"></td></tr>
									<tr><th><label><b>Página web<label><b></th> <td> <input type="url" name="dirWeb"  autocomplete="off" maxlength="30" placeholder="http://www.ejemplo.com" class="form-control"/> </td> </tr>
									<tr><th><label><b>Categoría</b></label></th><td><?php echo"<select name='categoria' class='form-control' required>
								 	<option value='0'>Seleccione una Opción</option>";
											foreach($CargaCombo7 as $comboCat): 										 
										echo "<option value=".$comboCat['id_categoria'].">". $comboCat['categoria']."</option>";
											endforeach; 
										echo "</select>";?>
									</td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
                               </table>
							</li>
						</ul>
					</li>
					
		
					<!--caja de texto oculta para la tabla det_bak_cli-->
					<input type="hidden" name="idDetBank" value="<?php echo $Clientes['idDetBank']?>"/></td></tr>
				
						<li><a href="#"><b>Datos Dirección Física</b></a>
							<ul>
								<li>
									<table class="nuevo-pro" width="70%">											
                                       <tr>
										<th><!--Clave--></th><td width="264px"></td><td><input type="hidden" class="form-control" name="idDir" value="<?php echo $Clientes['idDir'] ?>" readonly /></td></tr>										
 										<tr>
										<th>Estado:</th><td width="264px"></td>
									<td>   
									<select id="idEdo" name="idEdo" required='required' class="form-control" placeholder="Selecciona un Estado">
									<option value="">Selecciona un Estado</option>
									 <?php                 
										foreach($comboEstados as $codPost): 
										 
										echo "<option value=".$codPost['id_estado'].">". $codPost['estado']."</option>";

										endforeach; ?>
										</select></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									<tr>    
									<th>Municipio:</th><td width="300px"></td>
									<td>   										    
									<select id="municipios" name="municipios" required='required' class="form-control" placeholder="Selecciona tú municipio...">
									<option value="">Selecciona tú municipio...</option>
	    
									</select> </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
								<tr>  
								<th>Localidad:</th><td width="300px"></td>
								<td>   										    
								<select id="localidades" name="localidades" required='required' class="form-control" placeholder="Selecciona tú Localidad...">
							<option value="">Selecciona tú Localidad...</option>
							</select></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>

						<tr><th>Código Postal:</th><td width="300px"></td>
						 <td><input type="text" readonly name="id_cp" value="" id="id_cp" class="form-control">
						</td></tr>    
                        </table>
						<!--div con el resto del formulario de direccion-->			
						 <div id="visto" style="display:none;" style="visibility:hidden;">
						 <table border="0">						 
						       <tr>
								<th colspan='5'><MARQUEE Behavior ='slide' BGCOLOR='#92C9DC' WIDTH='100%'>Completar Datos de Dirección</MARQUEE></th></tr>
								<tr>
										<th>Colonia</th><td width="285px"></td>
										<td><input type='text'  name='colonia' class='form-control' required='required' placeholder='centro' maxlength='50' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									</tr>
									<tr>
										<th>Calle</th><td width="285px"></td>
										<td><input type='text'  name='calle'required='required' class='form-control' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' placeholder='Nicolas Bravo' maxlength='50' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									</tr>
									<tr>
										<th>Número Ext.</th><td width="285px"></td>
										<td><input type='text'  name='numExt' required='required' class='form-control' onkeypress='return justNumbers(event);' placeholder='158' /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
									</tr>
									<tr>
										<th>Numero Int.</th><td width="285px"></td>
										<td><input type='text'  name='numInt' class='form-control' onkeypress='return justNumbers(event);' placeholder='2'/></td>
									</tr>
									<tr>
										<th>Referencia</th><td width="285x"></td>
										<td><input type='text'  name='ref'  class='form-control' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' maxlength='40'onChange="aMayusculas(this)" /></td></tr>
									</tr>														
								</table>                                            
                                </div>      
                             </td></td></td></tr></tr></table>    
						</li>
					</ul>
				</li>	

					<li><a href="#"><b> Datos Fiscales</b></a>
						<ul>
							<li>
    						<div id="tFiscal">
							<!--Este es el formulario para agregar datos fiscales-->
        					<table class="nuevo-pro" border="0" width="70%">
							<tr><th><!--<label>Clave</label>--></th><td><input type="hidden" name="idDatF" value="<?php echo $idFisc;?>"readonly class="form-control"  /></td></tr>
							<tr><th><label><b>Razón Social</b></label></th><td><input type="text" name="razonS" placeholder="GRUPO RSA" class="form-control" required onChange="aMayusculas(this)" maxlength="30" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
							<tr><th><label><b>RFC</b></label></th><td><input type="text" name="rfc" maxlength="13" placeholder="VECJ880326 XXXX"  class="form-control" required onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
                            <tr>
							<td colspan="2"  BGCOLOR='#92C9DC'><b>Datos de Dirección Fiscal</b></td></tr>
            			<tr>
						<th><!--Clave--></th><td><input type="hidden" class="form-control" name="idDir2" value="<?php echo     $idDir2 ; ?>" readonly /></td></tr>										
						<tr>
						<th>Estado:</th>
						<td> 
          
						<select id="idEdo2" name="idEdo2" required class="form-control" placeholder="Selecciona un Estado">
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
						<select id="municipios2" name="municipios2" required class="form-control" placeholder="Selecciona tú municipio...">
						<option value="">Selecciona tú municipio...</option>
						 </select>
						 </td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
                        
                    	<tr>    
						<th>Localidad:</th>
						<td>   										    
						<select id="localidades2" name="localidades2" required class="form-control" placeholder="Selecciona tú Localidad...">
							<option value="">Selecciona tú Localidad...</option>
						    </select></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
						<tr>    
							<th>Código Postal:</th>
						<td>  										    
						<input type="text" readonly name="id_cp2" value="" id="id_cp2" class="form-control">
						 </td></tr>             
            		</table>


            		
						<!--div con el resto del formulario de direccion-->			
						 <div id="visto2" style="display:none;" style="visibility:hidden;">
						 <table width="70%">	                  
						   <tr>
						  	<th colspan='5'><MARQUEE Behavior ='slide' BGCOLOR='#92C9DC'>Completar Datosrrr de Dirección</MARQUEE></th></tr>
							<tr>
									<th>Colonia</th>
									<td><input type='text'  name='colonia2' class='form-control' required='required'  placeholder='centro' maxlength='30' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
								</tr>
								<tr>
									<th>Calle</th>
									<td><input type='text'  name='calle2' required='required' class='form-control' placeholder='Nicolas Bravo' maxlength='30' onChange="aMayusculas(this)" /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
								</tr>
								<tr>
									<th>Número Ext.</th>
									<td><input type='text'  name='numExt2' required='required' class='form-control' maxlength="4" onkeypress='return justNumbers(event);' placeholder='158' /></td><td><span class="span"><b>&nbsp;*</b></span></td></tr>
								</tr>
								<tr>
									<th>Numero Int.</th>
									<td><input type='text'  name='numInt2' class='form-control' onkeypress='return justNumbers(event);' maxlength="3" placeholder='2'/></td>
								</tr>
								<tr>
							<th>Referencia</th>
							<td><input type='text'  name='ref2'  class='form-control' pattern='|^[a-zA-Z ñÑáéíóúÁÉÍÓÚüÜ]*$|' maxlength='40'onChange="aMayusculas(this)" /></td></tr>

								</table>    
   	
   							<!--Aqui termina la sección-->                            
                 	  	 </div>



                        </li>
                    </ul>
                </li>
            </ul>

						<input type="submit" class="boton2" value="Continuar" name="Guardar" />
					</form>
		       <div id="addcl"></div>         
       		</div>
			</section>
		</div>
	</div>
</div>

</div>

					

<?php $contenido = ob_get_clean() ?>
<?php include '../app/templates/layout_second.php' ?>

<!--SCRIPTS DE COMOBOS MÁGICOS(SAM ñ_ñ)-->

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
       
   

        
 $('#divlocalidades').load('index.php?url=verLocalidad&select=1&idEdo=' + $('#formCliente').serialize());
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

<script>
				$('#idEdo2').selectize({
    onChange: function(value){

  
         select_city2.clearOptions();
   

        
 $('#divmunicipios2').load('index.php?url=verMunicipio&select=2&idEdo=' + value );
    }});
  
    
           $select_city2 = $('#municipios2').selectize({
    valueField: 'municipio',
    labelField: 'municipio',
    searchField: 'municipio',
    create: false,
        onChange: function(value){

  
         select_locale2.clearOptions();
       
   

        
 $('#divlocalidades2').load('index.php?url=verLocalidad&select=2&idEdo=' + $('#formCliente').serialize());
    }   
           });

    select_city2  = $select_city2[0].selectize;        
            
select_city2.disable();

            
$select_locale2 = $('#localidades2').selectize({
    valueField: 'id_cp',
    labelField: 'localidad',
    searchField: 'localidad',
    create: false,
        onChange: function(value){

              
        $('#id_cp2').val(value);
            
      $("#visto2").show();

    }   
           
           });
            
select_locale2  = $select_locale2[0].selectize;        
            
select_locale2.disable();
            
</script>


<!--Aqui carga los scripts para llenar los select-->
<div id="divmunicipios2">
<!--Aqui carga los scripts para llenar los select-->
</div>
<div id="divlocalidades2">
    <!--Aqui carga los scripts para llenar los select-->
</div>





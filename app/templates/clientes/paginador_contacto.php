	
<div id="Contenido">
    <h1>Asignar Contactos a Cliente</h1>

    <div id="addContacto">
<?php

//echo $idcli;

//Define el Array bidimencional
$AddContactos[]=array();
//se inicia el valor de a, que generara nuevas posiciones al array a partir de 0
$a=0;
foreach ($ContactosNo  as $item ) {
//verifica si $item aparece en contactos
    if (in_array($item, $Contactos )){
        //echo 'Existe'; 
    }
    //En caso de que el contacto no este en la lista de asignados
    else{
//se agregara el valor del array de $item(Contactos que no tienen relacion con el cliente actual) al nuevo array
      $AddContactos[$a]=$item;
        //se incrementa el valor de a para nuevos posibles contactos
    $a++;    
    }

}
//////////////////////////////////////////
//Comprobar que existan contactos

if(isset($AddContactos[0]['id_contacto']))
{

//Datos de la paginacion

//Registros que se mostraran por pagina, en la tabla
//Tambien se debe cambiar el valor en addContacto.php
    
    $RegistrosAMostrar=2;

    //estos valores los recibo por GET
if(isset($_GET['pag'])){
    $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
    
    $PagAct=$_GET['pag'];
   
    
    
}
else{
     //caso contrario los iniciamos

    $RegistrosAEmpezar=0;
    
    $PagAct=1;
}


$NroRegistros=count($AddContactos);
$PagAnt=$PagAct - 1;
$PagSig=$PagAct + 1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina


/////////////////////////
//Fin del calculo

?>

<!--Genera la tabla para mostrar los contactos-->
    <table class="table" id="miTabla"><tr>
        <th>Nombre</th>
        <th>Area</th>
        <th>Correo</th>
        <th>Telefono Móvil</th>
        <th>Opciones</th>
        </tr>
<?php

//definira el rango del array  que se mostrara en la tabla
//de acuerdo a la pagina y los registros a mostrar por pagina

$resultado=array_slice($AddContactos,$RegistrosAEmpezar,$RegistrosAMostrar);



//For para obtener los datos del array
for($i=0;$i<count($resultado);$i++) {

echo "<tr><td>"
    .$resultado[$i]['nombreCon']." "
    .$resultado[$i]['ap_paterno']." " 
    .$resultado[$i]['ap_materno']." "
    
    .'</td>';
    
echo "<td>"   .$resultado[$i]['nombre_area'].'</td>';    
echo "<td>"   .$resultado[$i]['correo_instu'].'</td>';    
echo "<td>"   .$resultado[$i]['movil'].'</td>';
//Formulario que manda las variables de cada fila
echo "<td>
<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
<input type = 'hidden' value = '".$resultado[$i]['id_cliente']."' name = 'id_cliente' id= 'id_cliente'>
<input type = 'hidden' value = '".$resultado[$i]['id_contacto']."' name = 'id_contacto' id= 'id_contacto'>


<input type='button' name='agregar' class='agregar' value='Agregar' />
		  </form>
</td>";   
 
echo"</tr>";
}


echo "</table>


";
?>
                

     
        <?php
/*Muestra la paginacion de la tabla*/

if($Res>0){
    
 $PagUlt=floor($PagUlt)+1;
}
//desplazamiento
echo "<center><table> <tr>";
if($PagAct>1) {
    
    echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoa' id='frmdoa' target='_self'>
<input type = 'hidden' value = '1' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='Primera'/>
</form>
</td>
";
    /*Para ir a la pagina anterior*/
echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdob' id='frmdob' target='_self'>
<input type = 'hidden' value = '$PagAnt' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='<<'/>
</form></td>";    
    
//echo "<strong color=blue>Pagina ".$PagAct."</strong>";
}

    /*para la paginacion*/
 for($i=1;$i<=$PagUlt;$i++) 
    {
     /*muestra las pagina anteriores a la actual*/
     if($i<$PagAct){
echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='$i'/>
</form>  </td>";    
     }
     /*Muestra la pagina actual*/
       if($i==$PagAct) 
       { 
           echo "<td><input type='button' value='".$PagAct."'/></td>";

        }
     /*Muestra las paginas siguientes a  la actual*/
     if($i>$PagAct){
         echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='$i'/>
</form>  </td>";
     }
    }

if($PagAct<$PagUlt)  {
/*Muestra el boton siguiente*/    
echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoc' id='frmdoc' target='_self'>
<input type = 'hidden' value = '$PagSig' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='>>'/>
</form></td>";
/*muestra el boton para ir a la ultima pagina*/
echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdod' id='frmdod' target='_self'>
<input type = 'hidden' value = '$PagUlt' name = 'pag' id= 'pag'>
<input type='button' name='change' class='change' value='Ultima'/>
</form></td>";

}
    echo "</td><td width='10'></td></tr></table></center>";
}
/*Muestra mensaje de que no hay contactos en la base 
o estan todos asignados a ese cliente*/
else{
echo "<h2>No hay Contactos Disponibles</h2>";
}

/*/////////////////////////////////////////////////////////////*/
/*Comprueba que existan contactos agregados al cliente*/
if(isset($Contactos[0]['id_contacto']))
{
?>    
<!--Seccion de contactos agregados al cliente-->
   <table class="table" id="miTabla"><tr>
        <th>Nombre</th>
        <th>Area</th>
        <th>Correo</th>
        <th>Telefono Móvil</th>
        <th>Opciones</th>
        </tr>
<?php

//For para obtener los arrays
for($i=0;$i<count($Contactos);$i++) {

echo "<tr><td>"
    .$Contactos[$i]['nombreCon']." "
    .$Contactos[$i]['ap_paterno']." " 
    .$Contactos[$i]['ap_materno']." "
    
    .'</td>';
    
echo "<td>"   .$Contactos[$i]['nombre_area'].'</td>';    
echo "<td>"   .$Contactos[$i]['correo_instu'].'</td>';    
echo "<td>"   .$Contactos[$i]['movil'].'</td>';
echo "
<td>
<form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
<input type = 'hidden' value = '".$Contactos[$i]['id_cliente']."' name = 'id_cliente' id= 'id_cliente'>
<input type = 'hidden' value = '".$Contactos[$i]['id_contacto']."' name = 'id_contacto' id= 'id_contacto'>

<input type='button' name='borrar' class='borrar' value='borrar' />
		  </form>
</td>";    
    

echo"</tr>";
}


echo "</table>";
}

/*Muestra mensaje de que no hay contactos asignados a ese cliente*/
else{
echo "<h2>No hay Contactos Asignados</h2>";
}

?>
   
       
<script type='text/javascript'>
//Funcion para agregar contacto a cliente
//<![CDATA[
$(function () {
	$('.agregar').click(
		function () {
			formulario = this.form;
			$('#addContacto').load('index.php?url=addcontactocli&',$(formulario).serialize());
		}
	);
});
//]]>

//Funcion para quitar contacto de cliente    
//<![CDATA[
$(function () {
	$('.borrar').click(
		function () {
			formulario = this.form;
			$('#addContacto').load('index.php?url=remcontactocli&',$(formulario).serialize());
		}
	);
});
//]]>
    //funcion para cambiar pagina mejorado xD
//<![CDATA[
$(function () {
	$('.change').click(
		function () {
			formulario = this.form;
			$('#tabla_paginacion').load('index.php?url=paginacion_contacto&idcli=<?php echo $idcli;?>&pag=',$(formulario).serialize());
		}
	);
});
//]]>    
    
    
</script>



    
    
            
    
    </div>
        
<div id="fromContacto">
        
</div>  
</div>    
              
        

<?php
require "../../config.php";
require "../../model.php";

if(strlen($_REQUEST['cp'])>=4)
{
    
function verCodPost()
		{
			if (!isset($_REQUEST['cp'])) {
				throw new Exception("Página no encontrada", 1);
			}
        
			$idCodPost = $_REQUEST['cp'];
				
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$codPost = $m->obtenerCodigoP($idCodPost);			
			$obtenerDatos = $codPost;
			return $obtenerDatos;
		}

$Cps= verCodPost();
    
    
			$id_dir = $_REQUEST['id_dir'];
    //echo $id_dir;
    
//print_r($Cps);

?>
    	
<form action="#" method="POST" name="frmdodir" id="frmdodir" target="_self">
    <!--Hidden con el id de la direccion-->
    
    <input type="hidden" value="<?php echo $id_dir;?>" name="id_dir" readonly/>
<table class="table" id="miTabla">
    
    <tr>

        <th>Estado</th>
            <th>Municipio</th>
            <th  width="10px">Localidad</th>
    </tr>
   
        <?php 

echo " <tr>
";
echo "<td>".$Cps[0]['estado']."</td>"; 
echo "<td>".$Cps[0]['municipio'] ."</td><td><select name='id_cp' >";
echo "
<option value='0'>Seleccione una Opción</option>
<option value='0'>-</option>";

foreach($Cps as $codPost): 
 
echo "<option value=".$codPost['id_cp'].">". $codPost['localidad']."</option>


";

endforeach; 
echo "</select> </td></tr>";


?>
</table>
    <table >    
<th>Completar Datos de Dirección</th>
<tr>
        <td>Colonia</td>
        <td><input type="text"  name="colonia" /></td>
    </tr>
    <tr>
        <td>Calle</td>
        <td><input type="text"  name="calle" /></td>
    </tr>
    <tr>

        <td>Número Ext.</td>
        <td><input type="text"  name="next" /></td>
    </tr>
    <tr>
        <td>Numero Int.</td>
        <td><input type="text"  name="nint" /></td>
    </tr>
    <tr>
        <td>Referencia</td>
        <td><input type="text"  name="ref" /></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Continuar" onclick="confirmar()"/></td>
    </tr>

</table>
    
    </form>
<div id="feo" class="feo">

</div>
<script>

            
function confirmar(){
    if (confirm('¿La Dirección Proporcionada es Correcta?')){
        
                    $(function (e) {
				$('#frmdodir').submit(function (e) {
					e.preventDefault()
					$('#dir').load('../app/templates/clientes/cp_view_savedir.php?' + $('#frmdodir').serialize())
				})
			})

    }
    else{
                $(function (e) {
				$('#frmdodir').submit(function (e) {
					e.preventDefault()
				})
			})
    
    
    }
}
                
			</script>

<?php    
    
}





 ?>

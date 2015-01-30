<?php
  $connect = mysql_connect("localhost","root","") or die(mysql_error("Error de servidor"));
  mysql_select_db("digitalmind",$connect);
  
  
  $consulta = "SELECT estado FROM codigos_postales GROUP BY estado ASC";
  $ejecutar = mysql_query($consulta);
  
  echo "<form name = 'form1' method = 'POST' action = '' >
  			<select id = 'estados'>";
  				while ($countRows = mysql_fetch_array($ejecutar)) {
  					echo "<option value = ".$countRows['id_cp'].">".$countRows['estado']."</option>";
  				}
			echo "</select>
  		</form>";	
//"SELECT municipio FROM codigos_postales WHERE estado = 'México' GROUP BY municipio"
?>
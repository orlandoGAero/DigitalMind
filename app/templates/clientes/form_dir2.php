<?php
if($select==2){
?>
<script>
         select_locale2.enable();
<?php 
if (isset($obtenerInfo[0]['localidad'])): 
foreach($InfoCP as $codPost): 
echo "select_locale2.addOption({
id_cp:'".$codPost['id_cp']."', 
localidad: '".$codPost['localidad']."'
});";
endforeach; 
?>
</script>
<?php
     endif ;   
}
else{
    
?>

<script>
         select_locale.enable();
<?php 
if (isset($obtenerInfo[0]['localidad'])): 
foreach($InfoCP as $codPost): 
echo "select_locale.addOption({
id_cp:'".$codPost['id_cp']."', 
localidad: '".$codPost['localidad']."'
});";
endforeach; 
?>
</script>
<?php 
 endif ;
    }

?>



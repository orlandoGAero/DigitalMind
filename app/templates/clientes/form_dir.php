<?php
if($select==2){
    ?>

<script>
     select_city2.enable();
<?php 

if (isset($obtenerInfo[0]['municipio'])): 
    foreach($InfoCP as $codPost): 
        echo "select_city2.addOption({municipio: '".$codPost['municipio']."'});";
    endforeach; 
?>
</script>

<?php
 endif ;   
    
}

else {
?>


<script>
     select_city.enable();
<?php 

if (isset($obtenerInfo[0]['municipio'])): 
    foreach($InfoCP as $codPost): 
        echo "select_city.addOption({municipio: '".$codPost['municipio']."'});";
    endforeach; 
?>
</script>
<?php 
endif ;
    
}
?>
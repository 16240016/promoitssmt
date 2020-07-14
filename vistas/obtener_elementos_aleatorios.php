<?php
$colores = array("Abarrotes alcohon", "Chedraui", "floreria", "abarrotes feli", "salchichoneria", "tacos");
$total = sizeof($colores);
echo "Array original";
var_export ($colores);
$numero = 3;
$seleccion = array_rand($colores, $numero);
echo '<br>';
for($i=0; $i<$numero; $i++){
	echo "Valor aleatorio $i : " . $seleccion[$i];
	echo '<br>';
}
echo '<br>';
echo $total;
?>
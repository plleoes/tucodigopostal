<?php 

include ("db.inc");
$enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
$opcionSeleccionada=$_GET["o"];

  $consulta3  = "SELECT csubactividad, subactividad FROM subactividades WHERE cactividad='$opcionSeleccionada' ORDER BY subactividad";
$resultado3 = mysql_query($consulta3) or die('La consulta fall&oacute;: ' . mysql_error());
$rows = array();
while($r = mysql_fetch_assoc($resultado3)) {
    $rows[] = $r;
}
print json_encode($rows);

// Cerrar la conexion
mysql_close($enlace); 
?>


<?php 
session_start();
include "head.inc";
include ("db.inc");


$usu = $_GET['u'];
$en = $_GET['e'];
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;:</div> ' . mysql_error());
     $h2 = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT codusu FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;:</div> ' . mysql_error());
     $cusu = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT codentrada FROM entradasp WHERE codusu='$cusu' AND codentrada='$en'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;:</div> ' . mysql_error());
     $eusu = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 

if ($_SESSION['usuv'] == $h2){
echo "<div id=\"Titulo2\"> <h1> Bienvenido $h2 </h1> <div id=\"topnav\" class=\"topnav\"><a href=\"./bien.php?u=$usu\" class=\"signin\"><span>Volver</span></a></div> </div>";
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";

}
else{
echo "<div id=\"Titulo2\"> <h1> Bienvenido $h2 </h1> <h2><A href=\"./acti.php?u=$usu\">Añadir actividad</A>  <A href=\"./sale.php\">Salir</A> </h2> </div>";
echo "<div id=\"contenedor\">";
echo "<div id=\"cuerpo\"> <pre>";
echo '   Usuario Desconocido </pre></h3> ';
exit();
}
if($eusu = $en){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");

// Realizar una consulta SQL
$consulta  = "SELECT nombre,bdes FROM entradasp WHERE codusu='$cusu' AND codentrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;:</div> ' . mysql_error());

$row=mysql_fetch_row($resultado);
$nom=$row[0];
  echo"<div id=\"t1\">
    Nombre:</div>$row[0]
    ";
  echo"<div id=\"t1\">
    Breve Descripción:</div>$row[1]
    ";
mysql_free_result($resultado);
$consulta  = "SELECT direccion,telefono,telefonom,pweb,descripcion,ofertas FROM entradasc WHERE centrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;:</div> ' . mysql_error());
$row=mysql_fetch_row($resultado);
  echo"<div id=\"t1\">
    Dirección:</div>$row[0]
    ";
  echo"<div id=\"t1\">
    Teléfono:</div>$row[1]
    ";
  echo"<div id=\"t1\">
    Teléfono Móvil:</div>$row[2]
    ";
$c=substr($row[3],7);
if($c == ""){
  echo"<div id=\"t1\">
    Página web:</div>No
    ";
}
else {  
echo"<div id=\"t1\">
    Página web:</div><A href=\"$row[3]\"> $c </A>
    ";
}
  echo"<div id=\"t1\">
    Descripción:</div><pre>$row[4] </pre>";
  echo"<div id=\"t1\">
    Tarifas:</div><pre>$row[5] </pre>";





mysql_free_result($resultado);
mysql_close($enlace); 
}
else{
echo '<h3 class="np_index_cuerpo"><pre>Operacion no permitida</pre></h3> ';
exit();
}

echo "</div>";
echo "</div>";
echo "</table>";
echo "<script>
  $(\"A\").hover(function () {
    $(this).css({ 'font-weight' :</div> 'bolder', 'font-style' :</div> 'italic'});
  }, function () {
    var cssObj = {
      'font-weight' :</div> '',
      'font-style' :</div> 'Normal'
    }
    $(this).css(cssObj);
  });
</script>";


  include "tail.inc";
?>

<?php 
session_start();

include "heade.inc";
include "db.inc";




function begin()
{
mysql_query("BEGIN");
}

function commit()
{
mysql_query("COMMIT");
}

function rollback()
{
mysql_query("ROLLBACK");
}

$us = $_GET['u'];
$en = $_GET['e'];

     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
      $consulta  = "SELECT email FROM usuarios WHERE hash2='$us'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $h2 = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT codusu FROM usuarios WHERE hash2='$us'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $cusu = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT codentrada FROM entradasp WHERE codusu='$cusu' AND codentrada='$en'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $eusu = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 

if ($_SESSION['usuv'] == $h2){

echo "<div id=\"Titulo2\"> <h1> Edición $h2 </h1> <div id=\"topnav\" class=\"topnav\"><a href=\"./bien.php?u=$us\" class=\"signin\"><span>Volver</span></a></div> </div>";
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
if($eusu = $en){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 

$consulta  = "SELECT nombre,bdes FROM entradasp WHERE codusu='$cusu' AND codentrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$row=mysql_fetch_row($resultado);
  echo"<div id=\"t1\">
    Nombre</div>$row[0]
    ";
  echo"<div id=\"t1\">
    Breve Descripción</div>$row[1]
    ";
mysql_free_result($resultado);
$consulta  = "SELECT direccion,poblacion,telefono,telefonom,pweb,descripcion,ofertas FROM entradasc WHERE centrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$row=mysql_fetch_row($resultado);
  echo"<div id=\"t1\">
    Dirección</div>$row[0]
    ";
echo "<form class=\"cmxform\" id=\"activi\" method=\"post\" action=\"gredit.php?u=$us&e=$en\" >";
echo "<p><label for=\"poblacion\">Población :</label><input name=\"poblacion\" id=\"cpoblacion\" value=$row[1]></p>";
echo "<p><label for=\"telefono\">Teléfono :</label><input name=\"telefono\" id=\"ctelefono\" value=$row[2]></p>";
echo "<p><label for=\"telefonom\">Teléfono móvil :</label><input name=\"telefonom\" id=\"ctelefonom\" value=$row[3]></p>";
echo "<p><label for=\"desc\">Descripción :</label><textarea name=\"desc\"  id=\"cdesc\" rows=\"15\" cols=\"20\" style=\"width: 70%\" class=\"tinymce\">$row[5]</textarea></p>";
echo "<p><label for=\"ofer\">Tarifas :</label><textarea name=\"ofer\" id=\"cofer\" rows=\"15\" cols=\"20\" style=\"width: 70%\" class=\"tinymce\">$row[6]</textarea></p>";
echo "<p><button class=\"submit\" type=\"submit\">Enviar</button></p>";
echo "</form>";

echo "</div>";
echo "</div>";



mysql_free_result($resultado);
mysql_close($enlace); 
}
else{
echo '<div id=\"Titulo2\"> <h1>Operacion no permitida</h1> ';
exit();
}
}
else{
echo "<div id=\"Titulo2\"> <h1> Usuario Desconocido </h1> </div>";
}


echo "<script>
  $(\"A\").hover(function () {
    $(this).css({ 'font-weight' : 'bolder', 'font-style' : 'italic'});
  }, function () {
    var cssObj = {
      'font-weight' : '',
      'font-style' : 'Normal'
    }
    $(this).css(cssObj);
  });
</script>";







  include "tail.inc";
?> 


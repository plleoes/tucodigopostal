<?php 
session_start();
include "heada.inc";
include ("db.inc");



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
$s=$_SESSION['usuv'];
$us = $_GET['u'];

     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE hash2='$us'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $h2 = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
      
if ($s == $h2){
echo "<div id=\"Titulo2\"> <h1> Añadir actividad o servicio para $h2 </h1> <div id=\"topnav\" class=\"topnav\"><a href=\"./bien.php?u=$us\" class=\"signin\"><span>Volver</span></a></div></div>";

echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";



echo "<form class=\"cmxform\" id=\"activi\" method=\"post\" action=\"contacti.php?u=$us\" >";


// Conexion, seleccion de base de datos
          $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
echo "<fieldset>";
echo "<legend>Introduzca los Datos</legend>";

echo "<p><label for=\"activ\">Actividad:</label>";


// Realizar una consulta SQL
$consulta  = "SELECT cactividad, actividad FROM actividades ORDER BY actividad";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$l=0;
// Impresion de resultados en HTML

if (mysql_num_rows($resultado)){
echo "<select name=\"activ\" id=\"cactiv\">";
while ($linea = mysql_fetch_row($resultado)) {
   if($l == 0) { $basesubact=$linea[0];  echo " <option value=\"$linea[0]\" selected=\"selected\">$linea[1]</option> \n"; }
    else {      echo " <option value=\"$linea[0]\">$linea[1]</option> \n";}
      $l++;
}
echo "</select></p>";
}

// Liberar conjunto de resultados
mysql_free_result($resultado);

mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
$consulta3  = "SELECT csubactividad, subactividad FROM subactividades WHERE cactividad='$basesubact' ORDER BY subactividad";
$l=0;
$resultado3 = mysql_query($consulta3) or die('La consulta fall&oacute;: ' . mysql_error());
echo "<p><label for=\"subactiv\">Subactividad:</label>";
if (mysql_num_rows($resultado3)){
echo "<select name=\"subactiv\" id=\"csubactiv\">";
while ($linea = mysql_fetch_row($resultado3)) {
   if($l == 0) { echo " <option value=\"$linea[0]\" selected=\"selected\">$linea[1]</option> \n"; }
    else {      echo " <option value=\"$linea[0]\">$linea[1]</option> \n";}
      $l++;
}
echo "</select></p>";
}

mysql_free_result($resultado3);


// Cerrar la conexion
mysql_close($enlace); 

echo "<p><label id=\"csuba\" for=\"nsubact\">Subactividad:</label><input name=\"nsubact\" id=\"cnsubact\"></p>";

echo "<p><label for=\"cp\">Código Postal:</label><input name=\"cp\" id=\"ccp\" size=5 maxlength=5></p>";

echo "<p><label id=\"cnom\" for=\"nombre\">Nombre Empresa:</label><input name=\"nombre\" id=\"cnombre\"><p></p></p>";
echo "<p><label id=\"cdir\" for=\"tipov\">Direccion (tipo de via, Nombre y numero):</label><label id=\"ctip\" for=\"tipov\"></label><select class=\"DireccionC\" name=\"tipov\" id=\"ctipov\">
				<option value=\"CALLE\">Calle</option>
				<option value=\"Gran Via\">Gran Via</option>
				<option value=\"ALAMEDA\">Alameda</option>
				<option value=\"AVDA\">Avenida</option>
				<option value=\"CAMINO\">Camino</option>
				<option value=\"CARRE\">Carrer</option>
				<option value=\"CTRA\">Carretera</option>
				<option value=\"GLORIETA\">Glorieta</option>
				<option value=\"KALEA\">Kalea</option>
				<option value=\"PASAJE\">Pasaje</option>
				<option value=\"PASEO\">Paseo</option>
				<option value=\"PLA&#xC7;A\">Pla&#xE7;a</option>
				<option value=\"PLAZA\">Plaza</option>
				<option value=\"RAMBLA\">Rambla</option>
				<option value=\"RONDA\">Ronda</option>
				<option value=\"RUA\">Rua</option>
				<option value=\"SECTOR\">Sector</option>
				<option value=\"TRVA\">Traves&#xED;a</option>
				<option value=\"URB\">Urbanizaci&#xF3;n</option>

</select>";
echo "<input class=\"DireccionC\" name=\"direccion\" id=\"cdireccion\"></p>";
echo "<p><label id=\"cpob\" for=\"poblacion\">Población :</label><input name=\"poblacion\" id=\"cpoblacion\"></p>";
echo "<p><label for=\"telefono\">Teléfono :</label><input name=\"telefono\" id=\"ctelefono\"></p>";
echo "<p><label for=\"telefonom\">Teléfono móvil :</label><input name=\"telefonom\" id=\"ctelefonom\"></p>";
echo "<p><label for=\"bdesc\">Breve descripción :</label><input name=\"bdesc\" id=\"cbdesc\">";
echo "<p><label for=\"pagw\">Página web :</label><input type=text name=\"pagw\" id=\"cpagw\" value=\"http://\"></p>";
echo "<p><label for=\"desc\">Descripción :</label><textarea name=\"desc\"  id=\"cdesc\" rows=\"15\" cols=\"20\" style=\"width: 70%\" class=\"tinymce\"></textarea></p>";
echo "<p><label for=\"ofer\">Tarifas :</label><textarea name=\"ofer\" id=\"cofer\" rows=\"15\" cols=\"20\" style=\"width: 70%\" class=\"tinymce\"></textarea></p>";

echo "<p><button class=\"submit\" type=\"submit\">Enviar</button></p>";
echo "</fieldset>";
echo "</form>";
}

else{
echo "<div id=\"Titulo2\"> <h1> Usuario Desconocido </h1> </div>";
}

echo "</div>";
echo "</div>";
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

<?php 


$cp = $_GET['c'];

if (strlen($cp)==5 && is_numeric($cp)){
include "headr.inc";
include ("db.inc");

$cp1=substr($cp, 0, 2);
$cp2=substr($cp, 2, 3);
echo "<title>Tu Codigo Postal: en $cp</title>";

include "head2.inc";

echo "<div id=\"Titulo2\"> <h1> Estas en $cp </h1>";

echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
echo "<div id=\"t1\">Actividades</div>";


     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");

// Realizar una consulta SQL
$consulta  = "SELECT t1.actividad, t2.cactividad FROM actividades t1, actividadescp t2 WHERE t2.cp1='$cp1' AND t2.cp2='$cp2' AND t1.cactividad=t2.cactividad ORDER BY t1.actividad";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
echo"<table width=auto border=0>";
echo"<table width=auto border=0>";
while($row=mysql_fetch_row($resultado)){
  echo"<tr>
    <td><A class=\"acp\" href=\"./sacp.php?c=$cp&ca=$row[1]\">$row[0]</A></td>
    </tr>";
}
echo"</table>";
}

else {
echo "Ninguna actividad se ha dado de alta en el $cp. ¿Quiere darse de alta? Registrese en la web con un ordenador personal<br>";


}




mysql_free_result($resultado);
mysql_close($enlace); 

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

echo "<script type=\"text/javascript\">
        $(document).ready(function() {

            $(\".signin\").click(function(e) {          
				e.preventDefault();
                $(\"fieldset#signin_menu\").toggle(300);
				$(\".signin\").toggleClass(\"menu-open\");
            });
			
			$(\"fieldset#signin_menu\").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent(\"a.signin\").length==0) {
					$(\".signin\").removeClass(\"menu-open\");
					$(\"fieldset#signin_menu\").hide();
				}
			});			
			
        });
</script>
<script type='text/javascript'>
    $(function() {
	  $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>";

  include "tail.inc";

}
else {
header("HTTP/1.0 404 Not Found"); 
}

?> 



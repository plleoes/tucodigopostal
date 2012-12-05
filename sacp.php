<?php 


$cp = $_GET['c'];
$cac = $_GET['ca'];
if (strlen($cp)==5 && is_numeric($cp) && is_numeric($cac)){
include "headr.inc";
include "db.inc";
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";

$cp1=substr($cp, 0, 2);
$cp2=substr($cp, 2, 3);
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
$consulta  = "SELECT actividad FROM actividades WHERE cactividad='$cac'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$h2 = mysql_result($resultado, 0);
mysql_free_result($resultado);
mysql_close($enlace); 
echo "<title>Tu Codigo Postal: en $cp y $h2</title>";

include "head2.inc";


echo "<div id=\"Titulo2\"> <h1> Estas en $cp y $h2 </h1> <h2>";
echo " <div id=\"topnav\" class=\"topnav\"> ¿No está registrado? <a href=\"login\" class=\"signin\"><span>Regístrese</span></a> </div>
  <fieldset id=\"signin_menu\">
    <form method=\"post\" id=\"signin\" action=\"/rusu.php\">
Email Personal:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME=\"email1\"<br><P>
Contraseña:&#09;&#09;&#09;<INPUT TYPE=PASSWORD NAME=\"pass1\"<br><P>
<INPUT TYPE=SUBMIT NAME=boton1 VALUE=Entrar><br><P>
¿Se te olvidó la contraseña? <A href=\"./ousu.php\">Pulsa aquí</A><P>
<A href=\"./ausu.php\">Cree su propia cuenta</A> o bien<br>
<A href=\"/openid-php/tcpflog/login/oidrequest.php?id=https://www.google.com/accounts/o8/id\">Entre con su cuenta de Google</A><br>
<A href=\"/openid-php/tcpflog/login/oidrequest.php?id=https://me.yahoo.com\">Entre con su cuenta de Yahoo<img src=\"yahoo2.png\" border=none alt=\"\"></A><br>
<A href=\"/fblogui.php\">Entre con su cuenta de Facebook<img src=\"facebook2.png\" border=none alt=\"\"></A><br>
    </form>
  </fieldset>
</div>";

echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
echo "<div id=\"t1\">Subactividades</div>";


     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 
// Realizar una consulta SQL
$consulta  = "SELECT t1.subactividad, t2.csubactividad FROM subactividades t1, subactividadescp t2 WHERE t2.cp1='$cp1' AND t2.cp2='$cp2' AND t2.cactividades='$cac' AND t1.csubactividad=t2.csubactividad ORDER BY t1.subactividad";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
echo"<table width=auto border=0>";
while($row=mysql_fetch_row($resultado)){
  echo"<tr>
    <td><A class=\"acp\" href=\"/$cp/$cac/$row[1].html\">$row[0]</A></td>
    </tr>";
}
echo"</table>";


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



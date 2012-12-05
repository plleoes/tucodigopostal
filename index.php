<?php 
include ("mdetect.php");
include "headin.inc";
include ("db.inc");
$uagent_obj = new uagent_info();
if ($uagent_obj->DetectMobileLong() == true || $uagent_obj->DetectSmartphone() == true){
echo "<script type=\"text/javascript\"> location.href=\"http://movil.tucodigopostal.es/\";</script>";
}
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";
echo "<div id=\"Titulo2\"> ";
echo " <div id=\"topnav\" class=\"topnav\"> ¿No está registrado? <a href=\"login\" class=\"signin\"><span>Acceder</span></a> </div>
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
echo "<div id=\"mainBox1\">";
echo "<div id=\"texto1\">";
echo"<table id=\"table\">";
echo "<FORM NAME=\"form1\" METHOD=POST ACTION=\"i.php\" >";
echo "<tr><td width=150px text-align=right>Código Postal:</td><td width=75px text-align=center><INPUT TYPE=TEXT SIZE = 5 MAXLENGTH = 5 NAME=\"cp\" </td><td width=100px text-align=left><INPUT TYPE=SUBMIT NAME=\"boton2\" VALUE=Buscar><br></td></tr>";
echo "</FORM >";
echo"</table>";
echo "</div>";
echo "<div id=\"texto2\">";
echo "Códigos postales en los que ya se ha dado de alta algún cliente:";
echo "</div>";
echo "<div id=\"textocp\">";
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
$c=1;
// Realizar una consulta SQL
$consulta  = "SELECT DISTINCT cp1, cp2 FROM actividadescp ORDER BY cp1, cp2";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
while($row=mysql_fetch_row($resultado)){
  echo "
    <A class=\"acp\" href=\"$row[0]$row[1].html\">$row[0]$row[1]</A>";
 
}
}
echo "</div>";

echo "<div id=\"texto1\">";
echo "</div>";
echo "<div id=\"texto1\">";


echo "Pruebe a entrar desde un movil Android, Iphone o Windows Phone 7 para probar la nueva web de móviles con geolocalización del codigo postal<br>";

echo '<A href="http://www.facebook.com/TuCodigoPostal">Siguenos en Facebook<img src="facebook2.png" border=none alt=""></A><br>';
echo '<script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/TuCodigoPostal" show_faces="false" width="450"></fb:like><br>';
echo "</div>";

echo "<div id=\"texto2\">";
echo "A continuación vemos un video explicativo de lo que hace la web, para verlo mejor ponerlo en resolución de 1080p y a pantalla completa.<br>";
echo "</div>";

echo "<object width=\"425\" height=\"344\"><param name=\"movie\" value=\"http://www.youtube.com/v/Ndr82TPZabo?hl=es&fs=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/Ndr82TPZabo?hl=es&fs=1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed></object>";
echo "<div id=\"texto1\">";
echo "</div>";
echo "<div id=\"texto2\">";
echo "En esta página no figuran opiniones de usuarios, únicamente información. <br>";
echo "Todos los que se hayan dado de alta o se den de alta y sean los primeros en su respectivo código postal hasta el 31/12/2011, tendrán todos los servicios presentes y futuros que de esta web gratis de por vida.<br>";
echo "</div>";

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
?>


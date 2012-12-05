<?php 

$en = $_GET['e'];
if ( is_numeric($en) ){
include "headr.inc";
include "db.inc";
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";

      $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT nombre FROM entradasp WHERE codentrada='$en'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $nom = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
echo "<title>Tu Codigo Postal: en $nom</title>";

include "head2.inc";


echo "<div id=\"Titulo2\"> <h1> Estas en $nom </h1>";
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



      $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");

// Realizar una consulta SQL
$consulta  = "SELECT nombre,bdes,cp1,cp2 FROM entradasp WHERE codentrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$row=mysql_fetch_row($resultado);
  echo"<div id=\"t1\">
    Nombre</div>$row[0]
    ";
$nombr = $row[0]; 
  echo"<div id=\"t1\">
    Breve Descripción</div>$row[1]
    ";
$dire = "españa " . " " . $row[2] . $row[3];
mysql_free_result($resultado);
$consulta  = "SELECT direccion,telefono,telefonom,pweb,descripcion,ofertas,poblacion FROM entradasc WHERE centrada='$en'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
$row=mysql_fetch_row($resultado);
  echo"<div id=\"t1\">
    Dirección</div>$row[0]
    ";
$dire = $dire . " " . $row[6] . " " . $row[0];
  echo"<div id=\"t1\">
    Teléfono</div>$row[1]
    ";
  echo"<div id=\"t1\">
    Teléfono Móvil</div>$row[2]
    ";
$c=substr($row[3],7);
if($c == ""){
  echo"<div id=\"t1\">
    Página web</div>No
    ";
}
else {  
echo"<div id=\"t1\">
    Página web</div><A class=\"acp\" href=\"$row[3]\"> $nombr </A>
    ";
}
  echo"<div id=\"t1\">
    Descripción</div><pre>$row[4] </pre>";
  echo"<div id=\"t1\">
    Tarifas</div><pre>$row[5] </pre>";



echo"<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAA3oKNGnx8_tC3UiQRQFXWPhQy9nbkjORgqVTFqtPomF6ivDe0KhSPB6fOlXCQNFEsALxA-zBiSBR2fw\" type=\"text/javascript\"></script> 
";
echo "<script type=\"text/javascript\">
";
echo"    var map = null;
";
echo"    var geocoder = null;
";
echo"    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById(\"map_canvas\"));
        geocoder = new GClientGeocoder();
      }
";


 echo "showAddress(\"$dire\",\"$nombr\");
";
      
echo"    }
";
echo "    function showAddress(address, nom) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(pointa) {
            if (!pointa) {
              
            } else {
              map.setCenter(pointa, 15);
              var marker = new GMarker(pointa);
              map.addOverlay(marker);
              marker.openInfoWindowHtml(nom);
             }
          }
        );
      }
    }";

echo"    </script>";

echo "<br>";

if (strlen($row[0])>2){
echo "  <body onload=\"initialize()\" onunload=\"GUnload()\">
<div id=\"t1\">Mapa</div>
    <div id=\"map_canvas\" style=\"width: 100%; height: 600px\"></div>
  </body>";
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



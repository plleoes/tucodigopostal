<?php 


$cp = $_GET['c'];
$cac = $_GET['ca'];
$csac = $_GET['csa'];
if (strlen($cp)==5 && is_numeric($cp) && is_numeric($cac) && is_numeric($csac)){
include "headr.inc";
include "db.inc";
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";

$cp1=substr($cp, 0, 2);
$cp2=substr($cp, 2, 3);
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 $consulta  = "SELECT actividad FROM actividades WHERE cactividad='$cac'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
else {
      $h2 = "";
}
mysql_free_result($resultado);
mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 $consulta  = "SELECT subactividad FROM subactividades WHERE csubactividad='$csac'";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h3 = mysql_result($resultado,0);
} 
else {
      $h3 = "";
}
mysql_free_result($resultado);
mysql_close($enlace); 
echo "<title>Tu Codigo Postal: en $cp, $h2 y $h3</title>";

include "head2.inc";


echo "<div id=\"Titulo2\"> <h1> Estas en $cp, $h2 y $h3 </h1>";
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
echo "<div id=\"t1\">$h3</div>";

     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 
// Realizar una consulta SQL
$consulta  = "SELECT codentrada,cp1,cp2,cactividad,csubactividad,nombre,bdes FROM entradasp WHERE cp1='$cp1' AND cp2='$cp2' AND cactividad='$cac' AND csubactividad='$csac' AND !borrado";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
echo"<table width=auto border=0>";
$letra = "A";
$i = 1;
while($row=mysql_fetch_row($resultado)){
$consulta2 = "SELECT direccion,poblacion FROM entradasc WHERE centrada='$row[0]'";
$resultado2 = mysql_query($consulta2) or die('La consulta fall&oacute;: ' . mysql_error());
while($row2=mysql_fetch_row($resultado2)){
if (strlen($row2[0])>2){
  echo"<tr>
    <td><img src=\"http://www.google.com/mapfiles/marker$letra.png\" border=none alt=\"\"><A class=\"acp\" href=\"/most.php?e=$row[0]\">$row[5] $row[6]</A></td>
    </tr>";
    $tdir[$i] = "españa " . " " . $row[1] . $row[2] . " " . $row2[1] . " " . $row2[0];
    $tnom[$i] = $row[5];
    $letra++;
    $i++;
}
else {
  echo"<tr>
    <td><A class=\"acp\" href=\"/most.php?e=$row[0]\">$row[5] $row[6]</A></td>
    </tr>";

}
}
mysql_free_result($resultado2);
}
echo"</table>";
$fint=$i;
$i=1;
echo"<script src=\"http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAA3oKNGnx8_tC3UiQRQFXWPhQy9nbkjORgqVTFqtPomF6ivDe0KhSPB6fOlXCQNFEsALxA-zBiSBR2fw\" type=\"text/javascript\"></script> 
";
echo "<script type=\"text/javascript\">
";
echo"    var map = null;
";
echo"    var geocoder = null;
";

echo "
        // Create a base icon for all of our markers that specifies the
        // shadow, icon dimensions, etc.
        var baseIcon = new GIcon(G_DEFAULT_ICON);
        baseIcon.shadow = \"http://www.google.com/mapfiles/shadow50.png\";
        baseIcon.iconSize = new GSize(20, 34);
        baseIcon.shadowSize = new GSize(37, 34);
        baseIcon.iconAnchor = new GPoint(9, 34);
        baseIcon.infoWindowAnchor = new GPoint(9, 2);
";

echo"    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById(\"map_canvas\"));
        geocoder = new GClientGeocoder();
      }
";

while($i<$fint){
 echo "showAddress(\"$tdir[$i]\",\"$tnom[$i]\", $i-1);
";
 $i++;

}
      
echo"    }
";

echo " 
        function createMarker(point, nomb, index) {
          // Create a lettered icon for this point using our icon class
          var letter = String.fromCharCode(\"A\".charCodeAt(0) + index);
          var letteredIcon = new GIcon(baseIcon);
          letteredIcon.image = \"http://www.google.com/mapfiles/marker\" + letter + \".png\";

          // Set up our GMarkerOptions object
          markerOptions = { icon:letteredIcon };
          var marker = new GMarker(point, markerOptions);

          GEvent.addListener(marker, \"click\", function() {
            marker.openInfoWindowHtml(nomb);
          });
          return marker;
        }
";

echo "    function showAddress(address, nom, ind) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(pointa) {
            if (!pointa) {
              
            } else {
              map.setCenter(pointa, 15);
              map.addOverlay(createMarker(pointa, nom, ind));
             }
          }
        );
      }
    }";

echo"    </script>";


mysql_free_result($resultado);
mysql_close($enlace); 
echo "<br>";
if ($letra != 'A'){

echo "  <body onload=\"initialize()\" onunload=\"GUnload()\">
<div id=\"t1\">Mapa</div>
    <div id=\"map_canvas\" style=\"width: 100%; height: 600px\"></div>
  </body>";
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


<?php 

include "headin.inc";
include ("db.inc");
echo "<script type=\"text/javascript\">
       $.cookie(\"long\", null);
       $.cookie(\"lat\", null);
</script>";

echo "<div id=\"bloque\">";
echo "<div id=\"mainBox1\">";
echo "<div id=\"texto1\">";
echo"<table id=\"table\">";
echo "<FORM NAME=\"form1\" METHOD=POST ACTION=\"i.php\" >";
echo "<tr><td width=150px text-align=right>Código Postal:</td><td width=75px text-align=center><INPUT TYPE=TEXT SIZE = 5 MAXLENGTH = 5 NAME=\"cp\" </td><td width=100px text-align=left><INPUT TYPE=SUBMIT NAME=\"boton2\" VALUE=Buscar><br></td></tr>";
echo "</FORM >";
echo"</table>";
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
    <A class=\"acp\" href=\"./acp.php?c=$row[0]$row[1]\">$row[0]$row[1]</A>";
 
}
}
echo "</div>";

echo "<div id=\"texto1\">";

echo '<A href="http://www.facebook.com/TuCodigoPostal">Siguenos en Facebook<img src="facebook2.png" border=none alt=""></A><br>';
echo '<script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/TuCodigoPostal" show_faces="false" width="100%"></fb:like><br>';
echo "En esta página no figuran opiniones de usuarios, únicamente información. <br>";
echo "Todos los que se hayan dado de alta o se den de alta y sean los primeros en su respectivo código postal hasta el 31/12/2011, tendrán todos los servicios presentes y futuros que de esta web gratis de por vida.<br>";
echo "Para darse de alta hay que hacerlo desde un ordenador personal. <br>";

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



  include "tail.inc";
?>


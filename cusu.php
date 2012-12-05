<?php 
session_start();
include "head.inc";
include ("db.inc");
include ("func.php");
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";


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


function peticiondatos($us,$n)
{
echo "<FORM METHOD=POST ACTION=\"./cusu.php?u=$us\" >";
echo "<div id=\"Titulo2\"> <h1> Cambiar Contraseña</h1><div id=\"topnav\" class=\"topnav\"><a href=\"./bien.php?u=$us\" class=\"signin\"><span>Volver</span></a></div></div>";
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
echo 'Contraseña antigua:&#09;&#09;&#09;<INPUT TYPE=PASSWORD NAME="apass"<br><P>';
echo "Introduzca 2 veces la contraseña para comprobar que la ha introducido bien.<br><P>";
echo 'Contraseña nueva:&#09;&#09;&#09;<INPUT TYPE=PASSWORD NAME="pass1"<br><P>';
echo 'Contraseña nueva:&#09; &#09; &#09;<INPUT TYPE=PASSWORD NAME="pass2"<br><P>';
echo '<INPUT TYPE=SUBMIT NAME="boton1" VALUE=Guardar><br><P>';
echo "</FORM>";
switch ($n) {
     case 1:
	echo "Error en email, introdúzcalos de nuevo <P>";
	break;
     case 2:
	echo "Ha escrito la contraseña vieja mal, introdúzcalas de nuevo <br><P>";
	break;
     case 3:
	echo "Las contraseñas no son iguales, introdúzcalas de nuevo <br><P>";
	break;
 }
echo '</pre></h2></h3>';
}

$se=$_SESSION['usuv'];
$usu = $_GET['u'];
if ( $_REQUEST[boton1] != "" ){
  $E1 = $_REQUEST[apass];
  $E3 = $_REQUEST[pass1];
  $E4 = $_REQUEST[pass2];
     $enlace2 = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta2  = "SELECT p FROM usuarios WHERE hash2='$usu'";
     $resultado1 = mysql_query($consulta2) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado1)){
            $h3 = mysql_result($resultado1,0);
} 
else {
      $h3 = "";
}
mysql_free_result($resultado1);
mysql_close($enlace2); 
if ( $h3 === $E1){
if ( $E3 === $E4 ){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
else {
      $h2 = "";
}
     mysql_free_result($resultado);
     mysql_close($enlace); 
     if ($h2 == $se){
     $shp=sha1($E3);
     $enlace = mysql_connect(S, USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
       $query = "UPDATE usuarios SET pass='$shp' ,p='$E3' WHERE email='$h2'";
       begin(); // transaction begins
       $result = mysql_query($query);
       if(!$result)
         {
         rollback(); // transaction rolls back
         echo "<div id=\"contenedor\">";
         echo "<div id=\"cuerpo\"> <pre> Web Ocupada, intentelo de nuevo </pre></div>";
         exit;
         }
       else
         {
         commit(); // transaction is committed
         echo "<div id=\"contenedor\">";
         echo "<div id=\"cuerpo\"> <pre> Contraseña cambiada, <A href=\"./bien.php?u=$usu\">volver</A></pre></div>";
        }
     mysql_close($enlace); 

     }
     else {
         echo "<div id=\"contenedor\">";
         echo "<div id=\"cuerpo\"> <pre>El usuario no existe.</pre></div>";
        }
}
else
{
echo "$h3  $E1 <br><P>";
peticiondatos($usu,3);

}
}
else
{
peticiondatos($usu,2);

}


   

}
else
{
peticiondatos($usu,0);

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


<?php 

include "headaus.inc";
include ("db.inc");
include ("func.php"); 

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


function peticiondatos($n)
{
echo '<FORM METHOD=POST ACTION="ausu.php" >';
echo '<div id="Titulo2"> <h1> Crear Cuenta de Usuario </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";

echo "Su email personal será su cuenta de usuario en esta pagina,<br> introdúzcalo 2 veces para comprobar que lo ha introducido bien.<br><P>";
echo 'Email Personal:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME="email1"<br><P>';
echo 'Email Personal:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME="email2"<br><P>';
echo "Introduzca 2 veces la contraseña para comprobar que la ha introducido bien.<br><P>";
echo 'Contraseña:&#09;&#09;&#09;<INPUT TYPE=PASSWORD NAME="pass1"<br><P>';
echo 'Contraseña:&#09; &#09; &#09;<INPUT TYPE=PASSWORD NAME="pass2"<br><P>';
echo '<INPUT TYPE=SUBMIT NAME="boton1" VALUE=Guardar><br><P>';
echo "</FORM>";
switch ($n) {
     case 1:
	echo "Error en email, introdúzcalos de nuevo <P>";
	break;
     case 2:
	echo "Los email son distintos, introdúzcalos de nuevo <br><P>";
	break;
     case 3:
	echo "Las contraseñas no son iguales, introdúzcalas de nuevo <br><P>";
	break;
 }
echo '</pre></h2></h3>';
}


if ( $_REQUEST[boton1] != "" ){
  $E1 = $_REQUEST[email1];
  $E2 = $_REQUEST[email2];
  $E3 = $_REQUEST[pass1];
  $E4 = $_REQUEST[pass2];
  
  if ( comprobar_email($E1) && $E1 == $E2 ){
     if ( $E3 === $E4 ){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE email='$E2'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
else {
      $h2 = "";
}
     mysql_free_result($resultado);
     mysql_close($enlace); 
     if ($h2 != ""){
         echo "<div id=\"contenedor\">";
         echo "<div id=\"cuerpo\"> <pre> El usuario ya está registrado, <A href=\"./rusu.php\">pruebelo aquí</A> </pre></div>";
     }
     else {
       $shp=sha1($E3);
       $shpmd=md5($E2);
     $enlace = mysql_connect(S, USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
       $query = "INSERT INTO usuarios (email,pass,hash2,p,tipo) VALUES ('$E1','$shp','$shpmd','$E4',0)";
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
         echo "<div id=\"cuerpo\"> <pre> Usuario Registrado, <A href=\"./rusu.php\">pruebelo aquí</A></pre></div>";
        }
     mysql_close($enlace); 
     }
     }
     else{
      peticiondatos(3);
      }
}
  elseif ( !comprobar_email($E1) ) {
        peticiondatos(1);}
     elseif ( $E1 <> $E2 ){
        peticiondatos(2);
    }
   

}
else
{
peticiondatos(0);

}
echo "</div>";
echo "</div>";

  include "tail.inc";
?> 




<?php 

include "headous.inc";

include ("func.php");
include "db.inc";
function peticiondatos($e)
{
echo '<FORM METHOD=POST ACTION="ousu.php" >';
echo '<div id="Titulo2"> <h1> Olvido de Contraseña </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";

echo "Escriba el correo con el que se dio de alta, y le enviaremos un email <br>con la contraseña<P>";
echo 'Email Personal:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME="email1"<br><P>';
echo "<INPUT TYPE=SUBMIT NAME=boton1 VALUE=Enviar><br><P>";
if ($e == 1) {
     
	echo "El email esta mal escrito, introdúzcalo de nuevo <P>";
	}
elseif ($e == 2)
{
     
	echo "El email no esta registrado, introdúzcalo de nuevo o <A href=\"./ausu.php\">Registrese</A><P> <P>";
	}
echo '</pre></h2></h3>';
echo "</FORM>";
}

if ( $_REQUEST[boton1] != "" ){
  $E1 = $_REQUEST[email1];
  if ( comprobar_email($E1)){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT p FROM usuarios WHERE email='$E1'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $h2 = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     if ($h2 != "" ) {
     $to = "$E1"; 
     $subject = 'Envio de contraseña'; 
$message = "Hola $E1:\r\n";
$message .= "\r\n";
$message .= "La contraseña con la que se registró es $h2\r\n"; 
$message .= "Un saludo, de Tu Código Postal\r\n";
$message .= "-------------------------------\r\n";
$message .= "Por favor, no respondas a este correo.\r\n\n"; 


$email = $E1; 
$mailheaders = "From: no_reply@tucodigopostal.es\n";
$mailheaders .= "Reply-To: admin@tucodigopostal.es\n";
$mailheaders .= "Content-Type: text/plain; charset=UTF-8\n\n";


          if(!mail($to, $subject, $message, $mailheaders)) {
              echo '<div id="Titulo2"> <h1> Olvido de Contraseña </h1></div>';
              echo "<div id=\"contenedor\">";
              echo "<div id=\"cuerpo\"> <pre>";
              echo "Error en el envio";
              echo '</pre></h2></h3>';
          } 
          else {
            echo '<div id="Titulo2"> <h1> Olvido de Contraseña </h1></div>';
            echo "<div id=\"contenedor\">";
            echo "<div id=\"cuerpo\"> <pre>";
            echo "Mensaje enviado";
            echo '</pre></h2></h3>';        
           }
       }
     else {
        peticiondatos(2);
     }
 }
  else {
        peticiondatos(1);
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



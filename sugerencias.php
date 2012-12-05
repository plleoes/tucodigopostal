
<?php 

include "headsug.inc";
include ("func.php"); 

function peticiondatos($e)
{
echo '<FORM METHOD=POST ACTION="sugerencias.php" >';
echo '<div id="Titulo2"> <h1> Sugerencias o Avisos </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
echo 'Email del Remitente:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME="email1"<br><P>';
echo 'Texto del mensaje:<br><P><TEXTAREA ROWS="6" COLS="60" NAME="sug"> </TEXTAREA><br>';
echo "<INPUT TYPE=SUBMIT NAME=boton1 VALUE=Enviar><br><P>";
echo '</pre></h2></h3>';
echo "</FORM>";
}

if ( $_REQUEST[boton1] != "" ){
     $to = "plleoes@gmail.com"; 
     $subject = 'Sugerencia o Aviso'; 
$message =  $_REQUEST[sug];
$from =  $_REQUEST[email1];
if ( !comprobar_email($from) ){
              echo '<div id="Titulo2"> <h1> Sugerencias o Avisos </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
              echo "Error en la dirección de remitente" ;
              echo '</pre></h2></h3>';

}
else {
$email = "plleoes@gmail.com";
$mailheaders = "From: $from\n"; 
$mailheaders .= "Reply-To: $from\n";
$mailheaders .= "Content-Type: text/plain; charset=UTF-8\n\n";
          if(!mail($to, $subject, $message, $mailheaders)) {
              echo '<div id="Titulo2"> <h1> Sugerencias o Avisos </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
              echo "Error de envio" ;
          } 
          else {
            echo '<div id="Titulo2"> <h1> Sugerencias o Avisos </h1></div>';
            echo "<div id=\"bloque\">";
            echo "<div id=\"mainBox\">";
            echo "Mensaje enviado";
           }
    
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



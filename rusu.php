<?php 
session_start();
include "headrus.inc";
include ("func.php");
include "db.inc";
function getRealIP()
{
   
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
             $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   
   return $client_ip;
   
}


function peticiondatos($e,$v)
{
echo '<FORM METHOD=POST ACTION="rusu.php" >';
echo '<div id="Titulo2"> <h1> Acceso a Usuario </h1></div>';
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";

echo 'Email Personal:&#09;&#09;&#09;<INPUT TYPE=TEXT NAME="email1"<br><P>';
echo 'Contraseña:&#09;&#09;&#09;<INPUT TYPE=PASSWORD NAME="pass1"<br><P>';
echo '<INPUT TYPE=SUBMIT NAME=boton1 VALUE=Entrar><br><P>';
switch ($e) {
     case 1:
	echo "El email o la contraseña estan mal escritos, introdúzcalos de nuevo <P>";
	break;
 }
echo '¿Se te olvidó la contraseña? <A href="./ousu.php">Pulsa aquí</A><P>';
echo '<A href="./ausu.php">Cree su propia cuenta</A> o bien<br>';
echo '<A href="/openid-php/tcpflog/login/oidrequest.php?id=https://www.google.com/accounts/o8/id">Entre con su cuenta de Google</A><br>';
echo '<A href="/openid-php/tcpflog/login/oidrequest.php?id=https://me.yahoo.com">Entre con su cuenta de Yahoo<img src="yahoo2.png" border=none alt=""></A><br>';
echo '<A href="/fblogui.php">Entre con su cuenta de Facebook<img src="facebook2.png" border=none alt=""></A><br>';

echo '</pre></h2></h3>';
echo "</FORM>";
}

if ( $_REQUEST[boton1] != "" ){
  $E1 = $_REQUEST[email1];
  $E2 = $_REQUEST[pass1];
  if ( comprobar_email($E1)){
     $sh1=sha1($E2); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
      $consulta  = "SELECT hash2 FROM usuarios WHERE email='$E1' AND pass='$sh1'";
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
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
            $consulta  = "SELECT codusu FROM usuarios WHERE email='$E1' AND pass='$sh1'";
           $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h3 = mysql_result($resultado,0);
} 
else {
      $h3 = "";
}
           mysql_free_result($resultado);
           mysql_close($enlace); 
           $ip=getRealIP();
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
           $query = "INSERT INTO logusu (codusu,fechah,ipdeusu) VALUES ('$h3',NOW(),'$ip')";
           $result = mysql_query($query);
       
        
           mysql_close($enlace); 


          $_SESSION['usuv']=$E1;
          $_SESSION['p']=0;
          echo "<script language=Javascript> location.href=\"./bien.php?u=$h2\"; </script>"; 
     }
     else {
        peticiondatos(1,$E1);
     }
     
    }
  elseif ( !comprobar_email($E1) ) {
        peticiondatos(1,$E1);}
     
    
   

}
else
{
peticiondatos(0,$E1);

}
echo "</div>";
echo "</div>";


  include "tail.inc";
?>

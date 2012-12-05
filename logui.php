<?php
session_start(); 
$email = $_GET['e'];

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



     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE email='$email'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
else {
      $h2 = "";
}

     mysql_free_result($resultado);
     mysql_close($enlace); 
     if ($h2 == "") {
       $shp=sha1($email);
       $shpmd=md5($email);
       $E4="nada";
  
     $enlace = mysql_connect(S, USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
       $query = "INSERT INTO usuarios (email,pass,hash2,p,tipo) VALUES ('$email','$shp','$shpmd','$E4',0)";
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

        }
     mysql_close($enlace); 
     }

     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
      $consulta  = "SELECT hash2 FROM usuarios WHERE email='$email'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
  
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
            $consulta  = "SELECT codusu FROM usuarios WHERE email='$email'";
           $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h3 = mysql_result($resultado,0);
} 
           mysql_free_result($resultado);
           mysql_close($enlace); 
           $ip=getRealIP();
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
           $query = "INSERT INTO logusu (codusu,fechah,ipdeusu) VALUES ('$h3',NOW(),'$ip')";
           $result = mysql_query($query);
       
        
           mysql_close($enlace); 

 
          $_SESSION['usuv']=$email;
          $_SESSION['p']=0;
         echo "<script language=Javascript> location.href=\"./bien.php?u=$h2\"; </script>"; 


  include "tail.inc";
?>

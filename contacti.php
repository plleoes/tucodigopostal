<?php 
include "db.inc";

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

$usu = $_GET['u'];
if ( $_POST[cp] != "" && $_POST[nombre] != "" && $_POST[direccion] != "" && $_POST[poblacion] != ""){
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);

     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT codusu FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
     $cusu = mysql_result($resultado, 0);
     mysql_free_result($resultado);
     mysql_close($enlace); 
     $cp=$_POST[cp];
     $cp1=substr($cp, 0, 2);
     $cp2=substr($cp, 2, 3);
     $ac=$_POST[activ];
     $sac=$_POST[subactiv];
     $nsac=$_POST[nsubact];
     $cac = $ac;
     if ( $sac != 0){
     $csac = $sac;
     }
     elseif ($nsac != "") {
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
       $query = "INSERT INTO subactividades (cactividad,subactividad) VALUES ('$cac','$nsac')";
       $result = mysql_query($query);
       $csac=mysql_insert_id();
      mysql_free_result($result);
     mysql_close($enlace); 
     }

     $nom=$_POST[nombre];
     $dire=$_POST[tipov] . " " . $_POST[direccion];
     $loc=$_POST[poblacion];
     $tlf=$_POST[telefono];
     $tlfm=$_POST[telefonom];
     $web=$_POST[pagw];
     $bdesc=$_POST[bdesc];
     $des=$_POST[desc];
     $ofe=$_POST[ofer];
     settype( $cusu, "integer" );
     settype( $cac, "integer" );
     settype( $csac, "integer" );
     $c=gettype($csac);
      
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $query1 = "INSERT INTO entradasp (codusu,cp1,cp2,cactividad,csubactividad,nombre,bdes) VALUES ('$cusu','$cp1','$cp2','$cac','$csac','$nom','$bdesc')";
       $query2 = "INSERT INTO entradasc (centrada,direccion,poblacion,telefono,telefonom,pweb,descripcion,ofertas) VALUES (LAST_INSERT_ID(),'$dire','$loc','$tlf','$tlfm','$web','$des','$ofe')";
       begin(); // transaction begins
       $result1 = mysql_query($query1,$enlace);       
       $result2 = mysql_query($query2,$enlace);

       if(!$result1 || !$result2)
        {
         rollback(); // transaction rolls back
         echo "<h3 class=\"np_index_cuerpo\"><pre> Web Ocupada, intentelo de nuevo </pre></h2>";
         exit;
         }
       else
         {
         commit(); // transaction is committed
         $consulta1  = "SELECT COUNT(*) FROM actividadescp WHERE cp1='$cp1' AND cp2='$cp2' AND cactividad='$cac'";
         $resultado3 = mysql_query($consulta1) or die('La consulta fall&oacute;: ' . mysql_error());
         if (mysql_num_rows($resultado3)){
            $cac2 = mysql_result($resultado3,0);
         } 
         else {
           $cac2 = 0;
         }
         if( $cac2 == 0 ){
             $query = "INSERT INTO actividadescp (cp1,cp2,cactividad) VALUES ('$cp1','$cp2','$cac')";
             $result3 = mysql_query($query);
          }
         $consulta2  = "SELECT COUNT(*) FROM subactividadescp WHERE cp1='$cp1' AND cp2='$cp2' AND cactividades='$cac' AND csubactividad='$csac'";
         $resultado4 = mysql_query($consulta2) or die('La consulta fall&oacute;: ' . mysql_error());
         if (mysql_num_rows($resultado4)){
            $cac3 = mysql_result($resultado4,0);
         } 
         else {
           $cac3 = 0;
         }
         if( $cac3 == 0 ){
             $query = "INSERT INTO subactividadescp (cp1,cp2,cactividades,csubactividad) VALUES ('$cp1','$cp2','$cac','$csac')";
             $result4 = mysql_query($query);
          }


        }
      mysql_free_result($resultado3);
      mysql_free_result($resultado4);

     mysql_close($enlace); 
     echo "<head> 

<script type=\"text/javascript\">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8645230-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head> 
<body> 
<script type=\"text/javascript\">

var google_conversion_id = 1038064411;
var google_conversion_language = \"en\";
var google_conversion_format = \"2\";
var google_conversion_color = \"ffffff\";
var google_conversion_label = \"l3ZSCN-k5QEQm7b-7gM\";
var google_conversion_value = 0;
</script>
<script type=\"text/javascript\" src=\"http://www.googleadservices.com/pagead/conversion.js\">
</script>
<noscript>
<div style=\"display:inline;\">
<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"http://www.googleadservices.com/pagead/conversion/1038064411/?label=l3ZSCN-k5QEQm7b-7gM&amp;guid=ON&amp;script=0\"/>
</div>
</noscript>";
echo "<script language=Javascript> location.href=\"./bien.php?u=$usu\"; </script> </body>"; 


}
?>

<?php 
session_start();
include "head.inc";
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
$en = $_GET['e'];
$cop1 = $_GET['c1'];
$cop2 = $_GET['c2'];
$cac = $_GET['ca'];
$csubac = $_GET['cs'];
$se=$_SESSION['usuv'];
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
        $query1 = "UPDATE entradasp SET borrado=1 WHERE codentrada='$en'";
       begin(); // transaction begins
       $result1 = mysql_query($query1,$enlace);       

       if(!$result1)
        {
         $tes=1;
         rollback(); // transaction rolls back
         echo "<h3 class=\"np_index_cuerpo\"><pre> Web Ocupada, intentelo de nuevo </pre></h2>";
         exit;
         }
       else
         {
         commit(); // transaction is committed
         $tes=0;

        }
       if($tes == 0){
         $consulta1  = "SELECT COUNT(*) FROM entradasp WHERE cp1='$cop1' AND cp2='$cop2' AND cactividad='$cac' AND !borrado";
         $resultado3 = mysql_query($consulta1) or die('La consulta fall&oacute;: ' . mysql_error());
         $cac2 = mysql_result($resultado3, 0);
         if( $cac2 == 0 ){
             $query = "DELETE FROM actividadescp WHERE cp1='$cop1' AND cp2='$cop2' AND cactividad='$cac'";
             $result3 = mysql_query($query);
          }
         $consulta2  = "SELECT COUNT(*) FROM entradasp WHERE cp1='$cop1' AND cp2='$cop2' AND cactividad='$cac' AND csubactividad='$csubac' AND !borrado";
         $resultado4 = mysql_query($consulta2) or die('La consulta fall&oacute;: ' . mysql_error());
         $cac3 = mysql_result($resultado4, 0);
         if( $cac3 == 0 ){
             $query = "DELETE FROM subactividadescp WHERE cp1='$cop1' AND cp2='$cop2' AND cactividades='$cac' AND csubactividad='$csubac'";
             $result4 = mysql_query($query);
         }
        }
      mysql_free_result($resultado3);
      mysql_free_result($resultado4);

     mysql_close($enlace); 
 echo "<script language=Javascript> location.href=\"./bien.php?u=$usu\"; </script>"; 
  include "tail.inc";
?> 

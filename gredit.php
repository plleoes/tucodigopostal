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
$en = $_GET['e'];
if ( $_POST[telefono] != "" ){
     $local=$_POST[poblacion];     
     $des=$_POST[desc];
     $ofe=$_POST[ofer];
     $tlf=$_POST[telefono];
     $tlfm=$_POST[telefonom];
     
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);

     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
        $query1 = "UPDATE entradasc SET poblacion='$local', descripcion='$des', ofertas='$ofe', telefono='$tlf', telefonom='$tlfm' WHERE centrada='$en'";
       begin(); // transaction begins
       $result1 = mysql_query($query1,$enlace);       
print_r($result1);
       if(!$result1)
        {
         rollback(); // transaction rolls back
         echo "<h3 class=\"np_index_cuerpo\"><pre> Web Ocupada, intentelo de nuevo </pre></h2>";
         exit;
         }
       else
         {
         commit(); // transaction is committed


        }

     mysql_close($enlace); 
     echo "<script language=Javascript> location.href=\"./bien.php?u=$usu\"; </script>"; 

     


}
?> 

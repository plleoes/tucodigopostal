<?php 
if ( $_REQUEST[boton2] != "" && strlen($_REQUEST[cp])==5 && is_numeric($_REQUEST[cp])){
   $h2=$_REQUEST[cp];
header ("Location: $h2.html");
$_REQUEST[cp]="";  

}
else
{
header ("Location: index.php");

}
?>

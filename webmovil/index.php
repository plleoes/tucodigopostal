<?php 

include "headr.inc";


echo "<title>Tu Codigo Postal</title>";
echo "<script type=\"text/javascript\">
       $.cookie(\"long\", null);
       $.cookie(\"lat\", null);
</script>";

include "head2.inc";

echo "<div id=\"Titulo2\"> <h1> </h1>";

echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
  echo"
    <div id=\"topnav2\" class=\"topnav2\"><a href=\"./itcp.php\" class=\"signin\"><span>Sin geolocalización</span></a><br><br><br><a href=\"./g.html\" class=\"signin\"><span>Con geolocalización</span></a></div> 
    ";




echo "</div>";
echo "</div>";






  include "tail.inc";



?> 



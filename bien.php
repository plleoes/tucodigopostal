<?php 
session_start();
include "head.inc";
include "db.inc";
echo "<script src=\"http://code.jquery.com/jquery-1.4.4.js\"></script>";
echo "<script src=\"jquery.confirm-1.3.js\"></script>";

$_SESSION['p']=0;
$usu = $_GET['u'];
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
     $consulta  = "SELECT email FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $h2 = mysql_result($resultado,0);
} 
else {
      $h2 = "";
}

     mysql_free_result($resultado);
     mysql_close($enlace); 
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
      $consulta  = "SELECT codusu FROM usuarios WHERE hash2='$usu'";
     $resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
            $cusu = mysql_result($resultado,0);
} 
else {
      $cusu = "";
}

     mysql_free_result($resultado);
     mysql_close($enlace); 



if ($_SESSION['usuv'] == $h2){
echo "<div id=\"Titulo2\"> <h1> Bienvenido $h2</h1>  <div id=\"topnav\" class=\"topnav\"><a href=\"./acti.php?u=$usu\" class=\"signin\"><span>Añadir actividad</span></a>  <a href=\"./cusu.php?u=$usu\" class=\"signin\"> <span>Cambiar Contraseña</span></a>  <a href=\"./sale.php\" class=\"signin\"><span>Salir</span></a> </h2> </div></div>";
echo "<div id=\"bloque\">";
echo "<div id=\"mainBox\">";
}
else{
echo "<div id=\"Titulo2\"> <h1> Usuario Desconocido ";
exit();
}
     $enlace = mysql_connect(S , USUWEB, KKUSUWEB);
     mysql_select_db(CODIGOP) or die("No pudo seleccionarse la BD. ");
 
// Realizar una consulta SQL
$consulta  = "SELECT codentrada,cp1,cp2,cactividad,csubactividad,nombre,bdes FROM entradasp WHERE codusu='$cusu' AND !borrado";
$resultado = mysql_query($consulta) or die('La consulta fall&oacute;: ' . mysql_error());
if (mysql_num_rows($resultado)){
$ids=1;
while($row=mysql_fetch_row($resultado)){
  echo"
    <div id=\"topnav2\" class=\"topnav2\"><a class=\"acp\" href=\"./mostrar.php?u=$usu&e=$row[0]\">$row[5] $row[6]</a><a href=\"./edit.php?u=$usu&e=$row[0]\" class=\"signin\"><span>Editar</span></a><a id=\"borrar$ids\" href=\"#\" class=\"signin\"><span>Borrar</span></a></div> 
    ";
echo "<script>
$(\"#borrar$ids\").click(function() {
  location.href=\"./borrar.php?u=$usu&e=$row[0]&c1=$row[1]&c2=$row[2]&ca=$row[3]&cs=$row[4]\";
});
 
$(\"#borrar$ids\").confirm({
  msg:\"¿Esta seguro de borrarlo?\",
  dialogShow:\"fadeIn\",
  dialogSpeed:\"slow\",
  buttons: {
    ok: \"Si\",
    cancel: \"No\",
    wrapper:\"<button></button>\",
    separator:\"  \"
  }  
});
</script>";

$ids++;
}
}
else {
echo "$h2, no ha dado de alta ninguna actividad, hagalo <A href=\"./acti.php?u=$usu\">aqui</A>";

}


mysql_free_result($resultado);
mysql_close($enlace); 
echo "</div>";
echo "</div>";
echo "<script>
  $(\"A\").hover(function () {
    $(this).css({ 'font-weight' : 'bolder', 'font-style' : 'italic'});
  }, function () {
    var cssObj = {
      'font-weight' : '',
      'font-style' : 'Normal'
    }
    $(this).css(cssObj);
  });
</script>";

  include "tail.inc";
?>

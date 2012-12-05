<?php 
session_start();
include "head.inc";


 $_SESSION['usuv']="";
 unset($_SESSION['usuv']);
 $_SESSION = array();
 session_unset();
 session_destroy();
?>
<script typ="text/javascript">
opener.location.reload()
</script>
<?
echo "<script language=Javascript> location.href=\"./index.php\"; </script>";


  include "tail.inc";
?>

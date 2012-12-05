<?php
$c=$_GET['code'];


$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token?client_id=158422160850004&redirect_uri=http://www.tucodigopostal.es/falog/&client_secret=e771bd9036142ac2d556f1888d8a0419&code=' . $c); 
 $d = curl_exec($ch); 

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?$d"); 
 $da = curl_exec($ch); 

$data = json_decode($da);


if ($data) {      
echo "<script language=Javascript> location.href=\"../logui.php?e=" . $data->email; echo "\"; </script>";  
}

?>

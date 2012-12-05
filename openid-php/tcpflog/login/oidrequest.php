<?php

$oid_identifier = $_GET['id'];
$path_extra = dirname(dirname(dirname(__FILE__)));
$path = ini_get('include_path');
$path = $path_extra . PATH_SEPARATOR . $path;
ini_set('include_path', $path);

//      oid_request.php

// Just tested this with/for Google, needs trying with others ...
// $oid_identifier = 'https://www.google.com/accounts/o8/id';
// $oid_identifier = 'https://me.yahoo.com';


// Includes required files
require_once "Auth/OpenID/Consumer.php";
require_once "Auth/OpenID/FileStore.php";
require_once "Auth/OpenID/AX.php";

// Starts session (needed for YADIS)
session_start();
    $store_path = "/tmp/_php_consumer_test";

    if (!file_exists($store_path) &&
        !mkdir($store_path)) {
        print "Could not create the FileStore directory '$store_path'. ".
            " Please check the effective permissions.";
        exit(0);
    }

// Create file storage area for OpenID data
$store = new Auth_OpenID_FileStore($store_path);

// Create OpenID consumer
$consumer = new Auth_OpenID_Consumer($store);

// Create an authentication request to the OpenID provider
$auth = $consumer->begin($oid_identifier);

// Create attribute request object
// See http://code.google.com/apis/accounts/docs/OpenID.html#Parameters for parameters
// Usage: make($type_uri, $count=1, $required=false, $alias=null)
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/contact/email',2,1, 'email');
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/namePerson/first',1,1, 'firstname');
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/namePerson/last',1,1, 'lastname');

// Create AX fetch request
$ax = new Auth_OpenID_AX_FetchRequest;

// Add attributes to AX fetch request
foreach($attribute as $attr){
        $ax->add($attr);
}

// Add AX fetch request to authentication request
$auth->addExtension($ax);

// Redirect to OpenID provider for authentication
$url = $auth->redirectURL('http://www.tucodigopostal.es', 'http://www.tucodigopostal.es/openid-php/tcpflog/login/oidcatch.php');
header('Location: ' . $url);

?> 

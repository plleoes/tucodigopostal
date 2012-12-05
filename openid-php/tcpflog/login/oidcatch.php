<?php
$path_extra = dirname(dirname(dirname(__FILE__)));
$path = ini_get('include_path');
$path = $path_extra . PATH_SEPARATOR . $path;
ini_set('include_path', $path);

//      oid_catch.php

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
$auth = $consumer->complete('http://www.tucodigopostal.es/openid-php/tcpflog/login/oidcatch.php');

if ($auth->status == Auth_OpenID_SUCCESS) {
        // Get registration informations
        $ax = new Auth_OpenID_AX_FetchResponse();
        $obj = $ax->fromSuccessResponse($auth);

        // Print me raw
        $email = $obj->data['http://axschema.org/contact/email'][0];
        header ("Location: ../../../logui.php?e=$email");
        exit;


} else {
  // Failed
}

?>

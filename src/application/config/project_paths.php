<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author:      Carlos R. Herrera Marquez <cherreram2012@gmail.com>
 * 
 * @description: define for CodeIgniter environment the paths of projects  
 *               resources.
 */
/*
  |--------------------------------------------------------------------------
  | Paths de las clases del Negocio.
 */

$config['business-class'] = getcwd() . '/application/business/Business.php';
$config['business-client-class'] = getcwd() . '/application/business/Client.php';
$config['business-visitor-class'] = getcwd() . '/application/business/Visitor.php';
$config['business-client-status-class'] = getcwd() . '/application/business/ClientStatus.php';
$config['business-error-codes-class'] = getcwd() . '/application/business/ErrorCodes.php';
$config['business-own-exception-class'] = getcwd() . '/application/business/OwnException.php';

//Clases del negocio del Response
$config['business-response-class'] = getcwd() . '/application/business/Response/Response.php';
$config['business-response-login-token-class'] = getcwd() . '/application/business/Response/ResponseLoginToken.php';

//Exception de la BD
$config['db-exception-class'] = getcwd() . '/application/business/OwnException.php';
?>


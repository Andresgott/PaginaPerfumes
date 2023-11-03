<?php

$json = file_get_contents('php://input');
$datos = json_decode($json, true);


//print_r($datos);

if(is_array($datos)){
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $email = $datos['detalles']['payer']['email_address'];
    $nombre = $datos['detalles']['payer']['name']['given_name'];
    $apellido = $datos['detalles']['payer']['name']['surname'];
    $nit = $datos['detalles']['payer']['payer_id'];
    
}

$NIT = "1003579028941"; // NIT de 13 caracteres de longitud
$fechaHoraEmisor = date("YmdHisv"); // 17 caracteres de longitud
$sucursal = str_pad("1234", 4, "0", STR_PAD_LEFT); // 4 caracteres de longitud
$modalidad = "2"; // Computarizada en línea, 1 caracter
$tipo_emision = "1"; // Emisión en línea, 1 caracter
$tipo_factura = "2"; // Documento sin derecho a crédito fiscal
$tipo_documento = "1"; // Factura compra-venta
$num_factura = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
$punto_venta = str_pad("0000", 4, "0", STR_PAD_LEFT);

$cadena1 = $NIT; //. $fechaHoraEmisor . $sucursal . $modalidad . $tipo_emision . $tipo_factura . $tipo_documento . $num_factura . $punto_venta;
$cadena2 = $fechaHoraEmisor;
$cadena3 = $sucursal . $modalidad . $tipo_emision . $tipo_factura . $tipo_documento;
$cadena4 = $num_factura . $punto_venta;

// Calcular el módulo 11
$modulo11 = bcmod($cadena, 11);
$modulo112 = bcmod($cadena2, 11);
$modulo113 = bcmod($cadena3, 11);
$modulo114 = bcmod($cadena4, 11);

$aux = (int)($cadena . $modulo11); // Convierte la cadena a un número entero
$aux2 = (int)($cadena2 . $modulo112);
$aux3 = (int)($cadena3 . $modulo113);
$aux4 = (int)($cadena4 . $modulo114);

$modulo11Hex = dechex($aux);
$modulo11Hex2 = dechex($aux2);
$modulo11Hex3 = dechex($aux3);
$modulo11Hex4 = dechex($aux4);

$codigo_control = "A19E23EF34124CD";

$cuf = strtoupper($modulo11Hex . $modulo11Hex2 . $modulo11Hex3 . $modulo11Hex4 . $codigo_control);







include 'factura.php';
<?php

function registrarCliente(array $datos,$con)
{
    $sql=$con->prepare("INSERT INTO cliente(Nombre,Apellido,Email,Telefono) VALUES(?,?,?,?)");
    $primeros_datos=array_slice($datos,0,4);
    $email=$datos[2];
    $password=$datos[4];
    #print_r($email);
    #print_r($password);
    if($sql->execute($primeros_datos))
    {
        return $con->lastInsertId();
    }
    return 0;
}

function registrarUsuario(array $datos,$con)
{
    $sql=$con->prepare("INSERT INTO usuario(Cliente_CodCL,Email,Password) VALUES(?,?,?)");
    $email=$datos[0];
    $Cod_CL=getCODCl($email,$con);
    $password=$datos[1];
    $segundos_datos =array($Cod_CL,$email,$password);
    #echo gettype($email);
    if($sql->execute($segundos_datos))
    {
        return true;
    }
    return false;
}

function obtenerUsuario(array $datos, $con)
{
    $email = $datos[0];
    $password = $datos[1];

    $sqlEmail = $con->prepare("SELECT Email FROM usuario");
    $sqlEmail->execute();
    $emails = $sqlEmail->fetchAll(PDO::FETCH_COLUMN);

    $sqlPassword = $con->prepare("SELECT Password FROM usuario WHERE Email = ?");
    $sqlPassword->execute([$email]);
    $dbPassword = $sqlPassword->fetchColumn();

    if ($password == $dbPassword) 
    {
        $sqlSaludo = $con->prepare("SELECT Nombre FROM cliente WHERE Email = ?");
        $sqlSaludo->execute([$email]);
        $nombre = $sqlSaludo->fetchColumn();
        echo "Bienvenido " . $nombre;
        return true;
    }
    else
    {
        return false;
    }
}
function getCODCl($email, $con)
{
    $sql = $con->prepare("SELECT CodCL FROM cliente where Email=?");
    $sql->execute([$email]);
    $res = $sql->fetchColumn();

    return $res;
}



?>
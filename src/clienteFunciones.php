<?php

function registrarCliente(array $datos,$con)
{
    $sql=$con->prepare("INSERT INTO clientes(Nombre,Apellido,Telefono,Mail) VALUES(?,?,?,?)");
    if($sql->execute($datos))
    {
        return $con->lastInsertId();
    }
    return 0;
}

function registrarUsuario(array $datos,$con)
{
    $sql=$con->prepare("INSERT INTO usuario(Password) VALUES(?)");
    if($sql->execute($datos))
    {
        return true;
    }
    return false;
}



?>
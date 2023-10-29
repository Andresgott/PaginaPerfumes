<?php

require 'Config/database.php';
require 'src/clienteFunciones.php';

$db=new Database();
$con=$db->conectar();

$errors=[];



echo ('hola');
echo ($_POST);
var_dump($_POST);

if($_POST==null)
{
    echo('El formulario esta vacio');
}

if(!empty($_POST))
{
    echo ('Entre al primer IF');
    if(isset($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['telefono'],$_POST['password'],$_POST['confirm_password']))
    {
        echo ('Entre al segundo IF');
        $nombre=trim($_POST['nombre']);
        $apellido=trim($_POST['apellido']);
        $email=trim($_POST['email']);
        $telefono=trim($_POST['telefono']);
        $password=trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $id=registrarCliente([$nombre,$apellido,$email,$telefono,$password],$con);

        if($id>0 and $confirm_password==$password)
        {
            registrarUsuario([$password],$con);
        }
        else
        {
            $errors[]= 'Error al registrar el cliente';
        }

        if(count($errors)==0)
        {
            exit;
        }
        else
        {
            print_r($errors);
        }
    }
    else
    {
        echo 'Formulario incompleto';
    }
    
}

?>




<?php

require 'C:/Users/Giga Servy/Desktop/PaginaPerfumes/Config/database.php';
require 'clienteFunciones.php';

$db=new Database();
$con=$db->conectar();

$errors=[];

#echo ('hola');
#echo ($_POST);

if(!empty($_POST))
{
    #echo('Entre al primer if');
    if(isset($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['telefono'],$_POST['password'],$_POST['confirm_password']))
    {
        #echo('Entre al segundo if');
        $nombre=trim($_POST['nombre']);
        $apellido=trim($_POST['apellido']);
        $email=trim($_POST['email']);
        $telefono=trim($_POST['telefono']);
        $password=trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $id=registrarCliente([$nombre,$apellido,$email,$telefono,$password],$con);

        if($id>0 and $confirm_password==$password)
        {
            registrarUsuario([$email,$password],$con);
            echo('Exito');
            echo '<script>
            setTimeout(function() {
                window.location.href = "http://localhost:4200/#inicio";
            }, 2000); // 2000 milisegundos (2 segundos)
            </script>';
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




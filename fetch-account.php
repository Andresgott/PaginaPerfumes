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
    if(isset($_POST['email'],$_POST['password']))
    {
        #echo('Entre al segundo if');
        
        $email=trim($_POST['email']);
        $password=trim($_POST['password']);
        $id=obtenerUsuario([$email,$password],$con);

        if($id>0)
        {
            echo('Exito!');
            echo '<script>
            setTimeout(function() {
                window.location.href = "http://localhost:4200/#inicio";
            }, 2000); // 2000 milisegundos (2 segundos)
            </script>';            
        }
        else
        {
            $errors[]= 'Error al ingresar a la cuenta';
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




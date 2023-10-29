<?php

require 'Config/database.php';
require 'src/clienteFunciones.php';

$db=new Database();
$con=$db->conectar();

$errors=[];

?>
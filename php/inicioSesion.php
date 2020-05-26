<?php

include("../conexion.php");

/*
include_once '../php/user.php';
include_once '../php/userSession.php';


 $userSession = new UserSession();
$user = new User();
*/

 if(isset($_SESSION['user'])){
   //$user->setUser($userSession->getCurrentUser());
   //.include_once '../paginas/usuario.html';
 }else if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
   $bd = conectar();
   $usuario = $_POST['usuario'];
   $contrasena = $_POST['contrasena'];

   //$contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
   $contrasenaHash = md5($contrasena);


   $sql = "SELECT * FROM usuario WHERE usuario= '$usuario' AND Contrasena='$contrasenaHash'";
   $resultado= mysqli_query($bd,$sql);
   $mostrar=sizeof(mysqli_fetch_array($resultado));



   if($mostrar>0){
     $sql2 = "SELECT * FROM usuario WHERE usuario= '$usuario' AND Contrasena='$contrasenaHash'";
     $resultado2= mysqli_query($bd,$sql2);
     while($mostrar2=mysqli_fetch_array($resultado2)){
       $tipo = $mostrar2['TipoUsuario'];
       $estado = $mostrar2['Estado'];
     }

     $mandar['mensaje'] = "Inicio de sesion correcto";
     $mandar['result'] = true;
     $mandar['Contrasena'] = $contrasenaHash;
     $mandar['Usuario'] = $usuario;
     $mandar['Tipo'] = $tipo;
     $mandar['Estado'] = $estado;
     $mandar['Key'] = md5("Key");
     echo json_encode($mandar);

   }else{
     $mandar['mensaje'] = "Error, datos incorrectos";
     $mandar['result'] = false;
     echo json_encode($mandar);
   }
 }else{
   include_once '../paginas/login.html';
 }








 ?>

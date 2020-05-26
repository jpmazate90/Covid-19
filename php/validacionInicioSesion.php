<?php

include("../conexion.php");

 if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
   $bd = conectar();
   $usuario = $_POST['usuario'];
   $contrasena = $_POST['contrasena'];

   //$contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
   $contrasenaHash = $contrasena;

   $sql = "SELECT * FROM usuario WHERE usuario= '$usuario' AND Contrasena='$contrasenaHash'";
   $resultado= mysqli_query($bd,$sql);
   $mostrar=sizeof(mysqli_fetch_array($resultado));


   if($mostrar>0){
     $sql2 = "SELECT * FROM usuario WHERE usuario= '$usuario' AND Contrasena='$contrasenaHash'";
     $resultado2= mysqli_query($bd,$sql2);
     while($mostrar2=mysqli_fetch_array($resultado2)){
       $imagen = $mostrar2['ImagenPerfil'];
       $correo = $mostrar2['CorreoElectronico'];
       $nombreCompleto =$mostrar2['NombreCompleto'];
       $confianza = $mostrar2['NivelConfianza'];
       $estado = $mostrar2['Estado'];
     }



     $mandar['mensaje'] = "Inicio de sesion correcto";
     $mandar['result'] = true;
     $mandar['imagen'] = $imagen;
     $mandar['correo'] = $correo;
     $mandar['nombreCompleto'] = $nombreCompleto;
     $mandar['confianza'] = $confianza;
     $mandar['estado'] = $estado;

     echo json_encode($mandar);

   }else{
     $mandar['mensaje'] = "Error, datos incorrectos";
     $mandar['result'] = false;
     echo json_encode($mandar);
   }
 }






 ?>

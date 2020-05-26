<?php

include("../conexion.php");

$bd = conectar();

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$nombreCompleto = $_POST['nombre'];
$correo = $_POST['correo'];
$fechaNacimiento = $_POST['fecha'];
$imagenPerfil =$_POST['imagen'];
$nivelConfianza = $_POST['confianza'];
$tipo = $_POST['tipo'];


$contrasenaHash = md5($contrasena);


$sql = "INSERT INTO usuario(Usuario,Contrasena,NombreCompleto,FechaNacimiento,CorreoELectronico,ImagenPerfil,NivelConfianza,TipoUsuario,Estado) VALUES ('$usuario','$contrasenaHash','$nombreCompleto','$fechaNacimiento','$correo','$imagenPerfil',$nivelConfianza,$tipo,1)";
$resultado= mysqli_query($bd,$sql);

if($resultado){
$mandar['mensaje'] = "Se creo correctamente el usuario";
$mandar['result'] = true;
 echo json_encode($mandar);
}else{
  $mandar['mensaje'] = mysqli_error($bd);
  $mandar['result'] = false;
  echo json_encode($mandar);
}

 ?>

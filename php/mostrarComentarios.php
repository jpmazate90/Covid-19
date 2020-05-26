
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];
$idHito = $_POST['idHito'];

 if($tipo == 'dashboard'){
  $sql = "SELECT
comentarioHito.Id, comentarioHito.Usuario, comentarioHito.IdHito, comentarioHito.Comentario,comentarioHito.Imagen,
comentarioHito.FechaPublicacion, usuario.ImagenPerfil
   FROM
  comentarioHito INNER JOIN usuario
   WHERE  usuario.Usuario=comentarioHito.Usuario AND comentarioHito.IdHito = $idHito ORDER BY FechaPublicacion DESC";
  $result= mysqli_query($bd,$sql);
  if($result){
    $mandar['mensaje'] = 'Consulta Exitosa';
    $mandar['datos'] =  $result->fetch_all(MYSQLI_ASSOC);
    $mandar['result'] = true;
    echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else{
  $mandar['mensaje'] = 'ERROR, TIPO DE ACCION INCORRECTA';
  $mandar['result'] = false;
  echo json_encode($mandar);
}




exit;

?>

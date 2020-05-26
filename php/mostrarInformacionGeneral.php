
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];

if($tipo == 'dashboard'){
  $sql = "SELECT * FROM  infoGeneral WHERE Estado=1 ORDER BY FechaPublicacion DESC";
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

}else if($tipo == 'dashboardFiltros'){
  $categoria =  $_POST['categoria'];

  $filtros = '';
  if($categoria !='' && $categoria !='null' ){
    $filtros = $filtros." AND Categoria='$categoria' ";
  }

  $sql = "SELECT * FROM  infoGeneral WHERE Estado=1 $filtros ORDER BY FechaPublicacion DESC";
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

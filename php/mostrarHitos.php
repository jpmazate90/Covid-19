
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];

if($tipo == 'perfil'){
  $sql = "SELECT * FROM hito WHERE usuario='$usuario' ORDER BY FechaPublicacion DESC";
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




}else if($tipo == 'dashboard'){
  $sql = "SELECT * FROM  hito WHERE  Aprobado<2 AND Estado<2 ORDER BY FechaPublicacion DESC";
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

}else if($tipo == 'dashboardAdmin'){
  $sql = "SELECT * FROM  hito ORDER BY Aprobado ASC, FechaPublicacion DESC";
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
  $vendedor =  $_POST['vendedor'];
  $fechaInicio =  $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $popularidad = $_POST['popularidad'];
  $aprobado = $_POST['aprobado'];

  $filtros = ' ';

  if($aprobado != '' && $verificado != 'null'){
    if($aprobado =="Aprobado"){
      $filtros = $filtros." AND hito.Aprobado=1 ";
    }else{
      $filtros = $filtros." AND hito.Aprobado=0 ";
    }
  }else{
    $filtros = $filtros." AND hito.Aprobado!=2 AND hito.Estado!=2 ";
  }

  if($categoria != '' && $categoria != 'null'){
    $filtros = $filtros." AND hito.categoria='$categoria' ";
  }
  if($vendedor !='' && $vendedor !='null'){
    $filtros = $filtros."AND hito.usuario LIKE '%$vendedor%' ";
  }
  if($fechaInicio!='' && $fechaFin == ''){
    $filtros = $filtros."AND hito.FechaPublicacion>'$fechaInicio' ";
  }else if($fechaInicio=='' && $fechaFin != ''){
    $filtros = $filtros."AND hito.FechaPublicacion<'$fechaFin' ";
  }else if($fechaInicio!='' && $fechaFin != ''){
    $filtros = $filtros."AND hito.FechaPublicacion BETWEEN '$fechaInicio' AND '$fechaFin' ";
  }

  $bandera = false;

  if($popularidad !='' && $popularidad !='null'){
    $bandera = true;
    if($popularidad=='Likes'){
      $filtros = $filtros." ORDER BY Likes DESC ";
    }else{
      $filtros = $filtros." ORDER BY Dislikes DESC ";
    }
  }
  if($bandera){
    $sql = "SELECT * FROM  hito WHERE  Estado<2 $filtros";

  }else{
    $sql = "SELECT * FROM  hito WHERE  Estado<2 $filtros ORDER BY FechaPublicacion DESC";

  }

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




}else if($tipo == 'dashboardFiltrosAdmin'){

  $categoria =  $_POST['categoria'];
  $vendedor =  $_POST['vendedor'];
  $fechaInicio =  $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $popularidad = $_POST['popularidad'];
  $aprobado = $_POST['aprobado'];

  $filtros = ' ';

  if($aprobado != '' && $verificado != 'null'){
    if($aprobado =="Aprobado"){
      $filtros = $filtros." AND hito.Aprobado=1 ";
    }else{
      $filtros = $filtros." AND hito.Aprobado=0 ";
    }
  }

  if($categoria != '' && $categoria != 'null'){
    $filtros = $filtros." AND hito.categoria='$categoria' ";
  }
  if($vendedor !='' && $vendedor !='null'){
    $filtros = $filtros."AND hito.usuario LIKE '%$vendedor%' ";
  }
  if($fechaInicio!='' && $fechaFin == ''){
    $filtros = $filtros."AND hito.FechaPublicacion>'$fechaInicio' ";
  }else if($fechaInicio=='' && $fechaFin != ''){
    $filtros = $filtros."AND hito.FechaPublicacion<'$fechaFin' ";
  }else if($fechaInicio!='' && $fechaFin != ''){
    $filtros = $filtros."AND hito.FechaPublicacion BETWEEN '$fechaInicio' AND '$fechaFin' ";
  }

  $bandera = false;

  if($popularidad !='' && $popularidad !='null'){
    $bandera = true;
    if($popularidad=='Likes'){
      $filtros = $filtros." ORDER BY Likes DESC ";
    }else{
      $filtros = $filtros." ORDER BY Dislikes DESC ";
    }
  }
  if($bandera){
    $sql = "SELECT * FROM  hito WHERE usuario=usuario $filtros , Aprobado DESC";

  }else{
    $sql = "SELECT * FROM  hito WHERE  usuario= usuario $filtros ORDER BY FechaPublicacion DESC, Aprobado DESC";

  }

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




}else if($tipo =='aprobar'){
  $id =  $_POST['id'];

  $sql = "UPDATE hito Set Aprobado=1, Estado=1 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE APROBO CON EXITO EL HITO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE APROBACION DE HITO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='rechazar'){
  $id =  $_POST['id'];

  $sql = "UPDATE hito Set Aprobado=2, Estado=2 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE RECHAZO CON EXITO EL HITO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE RECHAZO DE HITO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='despublicar'){
  $id =  $_POST['id'];

  $sql = "UPDATE hito Set Estado=2 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE DESPUBLICO CON EXITO EL HITO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE DESPUBLICAR DE HITO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='republicar'){
  $id =  $_POST['id'];

  $sql = "UPDATE hito Set Estado=1 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE REPUBLICO CON EXITO EL HITO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE REPUBLICAR DE HITO, Detalles: '.mysqli_error($bd);
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

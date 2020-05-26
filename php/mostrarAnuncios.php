
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];

if($tipo == 'perfil'){
  $sql = "SELECT * FROM anuncio WHERE usuario='$usuario' ORDER BY FechaPublicacion DESC";
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
  $lugar = $_POST['lugar'];

  $filtros = ' ';

  if($categoria != '' && $categoria != 'null'){
    $filtros = $filtros." AND anuncio.categoria='$categoria' ";
  }
  if($vendedor !='' && $vendedor !='null'){
    $filtros = $filtros."AND anuncio.usuario LIKE '%$vendedor%' ";
  }
  if($lugar !='' && $lugar !='null'){
    $filtros = $filtros."AND anuncio.lugar LIKE '%$lugar%' ";
  }
  if($fechaInicio!='' && $fechaFin == ''){
    $filtros = $filtros."AND anuncio.FechaPublicacion>'$fechaInicio' ";
  }else if($fechaInicio=='' && $fechaFin != ''){
    $filtros = $filtros."AND anuncio.FechaPublicacion<'$fechaFin' ";
  }else if($fechaInicio!='' && $fechaFin != ''){
    $filtros = $filtros."AND anuncio.FechaPublicacion BETWEEN '$fechaInicio' AND '$fechaFin' ";
  }


  $sql = "SELECT
  anuncio.Id,anuncio.Titulo, anuncio.Usuario, anuncio.FechaPublicacion, anuncio.Imagen, anuncio.CaracteristicasGenerales,
  anuncio.CaracteristicasEspecificas, anuncio.Categoria, anuncio.Lugar, anuncio.Aprobado, anuncio.Estado, usuario.NombreCompleto,usuario.CorreoElectronico
  FROM
  anuncio
  INNER JOIN usuario
  WHERE anuncio.Usuario = usuario.Usuario AND anuncio.Aprobado=1 AND anuncio.Estado=1 $filtros ORDER BY anuncio.FechaPublicacion DESC";
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
}else if($tipo == 'dashboardAdminFiltros'){

    $categoria =  $_POST['categoria'];
    $vendedor =  $_POST['vendedor'];
    $fechaInicio =  $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $lugar = $_POST['lugar'];


    $filtros = ' ';

    if($categoria != '' && $categoria != 'null'){
      $filtros = $filtros." AND anuncio.categoria='$categoria' ";
    }
    if($vendedor !='' && $vendedor !='null'){
      $filtros = $filtros."AND anuncio.usuario LIKE '%$vendedor%' ";
    }
    if($lugar !='' && $lugar !='null'){
      $filtros = $filtros."AND anuncio.lugar LIKE '%$lugar%' ";
    }
    if($fechaInicio!='' && $fechaFin == ''){
      $filtros = $filtros."AND anuncio.FechaPublicacion>'$fechaInicio' ";
    }else if($fechaInicio=='' && $fechaFin != ''){
      $filtros = $filtros."AND anuncio.FechaPublicacion<'$fechaFin' ";
    }else if($fechaInicio!='' && $fechaFin != ''){
      $filtros = $filtros."AND anuncio.FechaPublicacion BETWEEN '$fechaInicio' AND '$fechaFin' ";
    }


    $sql = "SELECT
    anuncio.Id,anuncio.Titulo, anuncio.Usuario, anuncio.FechaPublicacion, anuncio.Imagen, anuncio.CaracteristicasGenerales,
    anuncio.CaracteristicasEspecificas, anuncio.Categoria, anuncio.Lugar, anuncio.Aprobado, anuncio.Estado, usuario.NombreCompleto,usuario.CorreoElectronico
    FROM
    anuncio
    INNER JOIN usuario
    WHERE anuncio.Usuario = usuario.Usuario   $filtros ORDER BY Aprobado ASC";
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
    $sql = "SELECT
    anuncio.Id,anuncio.Titulo, anuncio.Usuario, anuncio.FechaPublicacion, anuncio.Imagen, anuncio.CaracteristicasGenerales,
    anuncio.CaracteristicasEspecificas, anuncio.Categoria, anuncio.Lugar, anuncio.Aprobado, anuncio.Estado, usuario.NombreCompleto,usuario.CorreoElectronico
    FROM
    anuncio
    INNER JOIN usuario
    WHERE anuncio.Usuario = usuario.Usuario AND anuncio.Aprobado=1 AND anuncio.Estado=1 ORDER BY anuncio.FechaPublicacion DESC";
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
  $sql = "SELECT
  anuncio.Id,anuncio.Titulo, anuncio.Usuario, anuncio.FechaPublicacion, anuncio.Imagen, anuncio.CaracteristicasGenerales,
  anuncio.CaracteristicasEspecificas, anuncio.Categoria, anuncio.Lugar, anuncio.Aprobado, anuncio.Estado, usuario.NombreCompleto,usuario.CorreoElectronico, anuncio.Estado, anuncio.Aprobado
  FROM
  anuncio
  INNER JOIN usuario
  WHERE anuncio.Usuario = usuario.Usuario ORDER BY Aprobado ASC";
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

  $sql = "UPDATE anuncio Set Aprobado=1, Estado=1 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE APROBO CON EXITO EL ANUNCIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE APROBACION DE ANUNCIO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='rechazar'){
  $id =  $_POST['id'];

  $sql = "UPDATE anuncio Set Aprobado=2, Estado=2 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE RECHAZO CON EXITO EL ANUNCIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE RECHAZO DE ANUNCIO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='despublicar'){
  $id =  $_POST['id'];

  $sql = "UPDATE anuncio Set Estado=2 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE DESPUBLICO CON EXITO EL ANUNCIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE DESPUBLICAR DE ANUNCIO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='republicar'){
  $id =  $_POST['id'];

  $sql = "UPDATE anuncio Set Estado=1 WHERE Id='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE REPUBLICO CON EXITO EL ANUNCIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE REPUBLICAR DE ANUNCIO, Detalles: '.mysqli_error($bd);
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

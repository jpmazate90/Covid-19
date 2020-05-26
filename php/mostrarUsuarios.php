
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];

 if($tipo == 'dashboardAdminFiltros'){


    $patron =  $_POST['nombre'];
    $fechaInicio =  $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $usuarioTipo = $_POST['usuarioTipo'];

    $filtros = ' ';


    if($patron !='' && $patron !='null'){
      $filtros = $filtros."AND  usuario.Usuario LIKE '%$patron%'";
    }
    if($usuarioTipo !='' && $usuarioTipo !='null'){
      if($usuarioTipo=='Administrador'){
      $filtros = $filtros."AND  usuario.TipoUsuario=2";
      }else{
        $filtros = $filtros."AND  usuario.TipoUsuario=1";
      }

    }
    if($fechaInicio!='' && $fechaFin == ''){
      $filtros = $filtros."AND usuario.FechaCreacion>'$fechaInicio' ";
    }else if($fechaInicio=='' && $fechaFin != ''){
      $filtros = $filtros."AND usuario.FechaCreacion<'$fechaFin' ";
    }else if($fechaInicio!='' && $fechaFin != ''){
      $filtros = $filtros."AND usuario.FechaCreacion BETWEEN '$fechaInicio' AND '$fechaFin' ";
    }


    $sql = "SELECT
    *
    FROM
    usuario
    WHERE usuario=usuario AND usuario!='root'  $filtros ORDER BY Usuario ASC";
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
  *
  FROM
  usuario
  WHERE Usuario!='root'
   ORDER BY Usuario ASC";
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





}else if($tipo =='habilitar'){
  $id =  $_POST['id'];

  $sql = "UPDATE usuario Set Estado=1 WHERE usuario='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE HABILITO CON EXITO EL USUARIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE HABILIITAR EL USUARIO, Detalles: '.mysqli_error($bd);
    $mandar['result'] = false;
    echo json_encode($mandar);
  }

}else if($tipo =='deshabilitar'){
  $id =  $_POST['id'];

  $sql = "UPDATE usuario Set Estado=0 WHERE usuario='$id'";
  $result= mysqli_query($bd,$sql);

  if($result){
    $mandar['mensaje'] = 'SE DESHABILITO CON EXITO EL USUARIO';
    $mandar['result'] = true;
     echo json_encode($mandar);
  }else{
    $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE DESHABILITACION DEL USUARIO, Detalles: '.mysqli_error($bd);
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

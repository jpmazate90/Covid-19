
<?php

include("../conexion.php");

$bd = conectar();


$usuario = $_POST['usuario'];
$tipo =  $_POST['tipo'];
$idHito =  $_POST['idHito'];

if($tipo == 'like'){
  $sql = "SELECT * FROM interracionHito WHERE Usuario='$usuario' AND IdHito=$idHito";
  $result= mysqli_query($bd,$sql);
  $mostrar = mysqli_fetch_array($result);


  if($mostrar>0){
    $sql2 = "SELECT * FROM interracionHito WHERE Usuario='$usuario' AND IdHito=$idHito";
    $resultado2= mysqli_query($bd,$sql2);

    while($mostrar2=mysqli_fetch_array($resultado2)){
      $inter = $mostrar2['TipoInteraccion'];
      $id = $mostrar2['Id'];
    }

    if($inter == 1){

      $mandar['mensaje'] = 'Ya le habias dado like al hito anteriormente';
      $mandar['accion'] = 'igualLike';
      $mandar['result'] = true;
      echo json_encode($mandar);
      exit ;

    }else{
      $sql3 = "UPDATE hito SET Likes=Likes+1, Dislikes=Dislikes-1 WHERE Id=$idHito";
      $result3= mysqli_query($bd,$sql3);
      $sql4 = "UPDATE interracionHito SET TipoInteraccion= 1 WHERE Id=$id";
      $result4= mysqli_query($bd,$sql4);

      $mandar['mensaje'] =  'Le habias dado dislike al hito anteriormente, ahora tiene un like';
      $mandar['accion'] =  'likeCambiado';
      $mandar['result'] = true;
      echo json_encode($mandar);
    }


  }else{

    $sql2 = "INSERT INTO interracionHito(IdHito, Usuario, TipoInteraccion) VALUES($idHito,'$usuario',1)";
    $result2= mysqli_query($bd,$sql2);

    if($result2){
      $sql3 = "UPDATE hito SET Likes=Likes+1 WHERE Id=$idHito";
      $result3= mysqli_query($bd,$sql3);
      $mandar['mensaje'] = 'Se dio like correctamente';
      $mandar['accion'] = 'like';
      $mandar['result'] = true;
      echo json_encode($mandar);


    }else{
      $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR EL LIKE, Detalles: '.mysqli_error($bd);
      $mandar['result'] = false;
      echo json_encode($mandar);
    }


  }

}elseif($tipo == 'dislike'){
  $sql = "SELECT * FROM interracionHito WHERE Usuario='$usuario' AND IdHito=$idHito";
  $result= mysqli_query($bd,$sql);
  $mostrar = mysqli_fetch_array($result);


  if($mostrar>0){
    $sql2 = "SELECT * FROM interracionHito WHERE Usuario='$usuario' AND IdHito=$idHito";
    $resultado2= mysqli_query($bd,$sql2);

    while($mostrar2=mysqli_fetch_array($resultado2)){
      $inter = $mostrar2['TipoInteraccion'];
      $id = $mostrar2['Id'];
    }

    if($inter == 2){

      $mandar['mensaje'] = 'Ya le habias dado Dislike al hito anteriormente';
      $mandar['accion'] = 'igualDislike';
      $mandar['result'] = true;
      echo json_encode($mandar);
      exit ;

    }else{
      $sql3 = "UPDATE hito SET Likes=Likes-1, Dislikes=Dislikes+1 WHERE Id=$idHito";
      $result3= mysqli_query($bd,$sql3);
      $sql4 = "UPDATE interracionHito SET TipoInteraccion= 2 WHERE Id=$id";
      $result4= mysqli_query($bd,$sql4);

      $mandar['mensaje'] =  'Le habias dado like al hito anteriormente, ahora tiene un dislike';
      $mandar['accion'] =  'dislikeCambiado';
      $mandar['result'] = true;
      echo json_encode($mandar);
    }
  }else{

    $sql2 = "INSERT INTO interracionHito(IdHito, Usuario, TipoInteraccion) VALUES($idHito,'$usuario',2)";
    $result2= mysqli_query($bd,$sql2);

    if($result2){
      $sql3 = "UPDATE hito SET Dislikes=Dislikes+1 WHERE Id=$idHito";
      $result3= mysqli_query($bd,$sql3);
      $mandar['mensaje'] = 'Se dio dislike correctamente';
      $mandar['accion'] = 'dislike';
      $mandar['result'] = true;
      echo json_encode($mandar);


    }else{
      $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR EL DISLIKE, Detalles: '.mysqli_error($bd);
      $mandar['result'] = false;
      echo json_encode($mandar);
    }


  }



}else{
  $mandar['mensaje'] = 'ERROR, TIPO DE ACCION INCORRECTA';
  $mandar['result'] = false;
  echo json_encode($mandar);
}




exit;

?>

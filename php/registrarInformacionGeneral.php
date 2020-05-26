


<?php

include("../conexion.php");

$bd = conectar();
$sql = "SELECT Anuncio FROM contadorImagenes";
$result= mysqli_query($bd,$sql);

while($mostrar=mysqli_fetch_array($result)){
    $valor = $mostrar['Anuncio'];
}
$numeroValor = (int) $valor;

$sql = "UPDATE contadorImagenes SET Anuncio= $numeroValor+1 WHERE Id=1";
$result= mysqli_query($bd,$sql);


// File name
$filename = $_FILES['file']['name'];

// Valid file extensions
$valid_extensions = array("jpg","jpeg","png","pdf");

// File extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);

$titulo = $_POST['titulo'];
$usuario = $_POST['usuario'];
$comentario = $_POST['comentario'];
$categoria = $_POST['categoria'];



// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {

   // Upload file
   $pathImagen = "../images/anuncios/".$usuario.'G'.$numeroValor.'G'.$filename;

   if(move_uploaded_file($_FILES['file']['tmp_name'], $pathImagen)){
     $cat = -1;
     if($categoria == 'SALUD'){
       $cat = 1;
     }else if($categoria == 'INFORMACION'){
       $cat = 2;
     }else if($categoria == 'RECOMENDACIONES'){
       $cat = 3;
     }else{
       $cat = 4;
     }

     $sql = "INSERT INTO infoGeneral(Usuario,Titulo,Imagen,Comentario,Categoria,Estado) VALUES(
      '$usuario', '$titulo', '$pathImagen', '$comentario',$cat,1)";
     $result= mysqli_query($bd,$sql);

     if($result){
       $mandar['mensaje'] = 'SE CREO CON EXITO LA PUBLICACION';
       $mandar['result'] = true;
        echo json_encode($mandar);
     }else{
       $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION, Detalles: '.mysqli_error($bd);
       $mandar['result'] = false;
       echo json_encode($mandar);
     }
   }else{
     $mandar['mensaje'] = 'NO SE LOGRO SUBIR LA IMAGEN POR LO TANTO, NO SE TERMINO DE PROCESAR LA PUBLICACION, en publicaciones';
     $mandar['result'] = false;
      echo json_encode($mandar);
   }
}else{
  $mandar['mensaje'] = 'LA EXTENSION DE LA IMAGEN NO ES CORRECTA, LAS EXTENSIONES VALIDAS SON: jpg, jpeg, png y pdf';
  $mandar['result'] = false;
   echo json_encode($mandar);
}

exit;

?>

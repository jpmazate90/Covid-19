
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
$generales = $_POST['generales'];
$especificas = $_POST['especificas'];
$categoria = $_POST['categoria'];
$lugar = $_POST['lugar'];

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {

   // Upload file
   $pathImagen = "../images/anuncios/".$usuario.'G'.$numeroValor.'G'.$filename;

   if(move_uploaded_file($_FILES['file']['tmp_name'], $pathImagen)){

     $sql = "INSERT INTO anuncio(Titulo,Usuario, Imagen, CaracteristicasGenerales, CaracteristicasEspecificas, Categoria, Lugar, Aprobado, Estado) VALUES(
        '$titulo','$usuario','$pathImagen','$generales','$especificas','$categoria','$lugar',0,0 )";
     $result= mysqli_query($bd,$sql);

     if($result){
       $mandar['mensaje'] = 'Se subio con exito el anuncio, espera a que los administradores lo validen para poder visualizarlo en la pagina';
       $mandar['result'] = true;
        echo json_encode($mandar);
     }else{
       $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION, Detalles: '.mysqli_error($bd);
       $mandar['result'] = false;
       echo json_encode($mandar);
     }
   }else{
     $mandar['mensaje'] = 'NO SE LOGRO SUBIR LA IMAGEN POR LO TANTO, NO SE TERMINO DE PROCESAR EL ANUNCIO';
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

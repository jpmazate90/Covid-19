<?php

include_once '../conexion.php';

class User{

  private $nombre;
  private $username;

  public function setUser($user){
     $bd = conectar();
     $sql = ("SELECT NombreCompleto, Usuario FROM usuario WHERE Usuario= '$user'");
     $result=mysqli_query($bd,$sql);
     while($mostrar=mysqli_fetch_array($result)){
        $this->nombre = $mostrar['NombreCompleto'];
        $this->usuario = $mostrar['Usuario'];
      }
  }

  public function getNombre(){
    return $this->nombre;
  }
  


}


 ?>

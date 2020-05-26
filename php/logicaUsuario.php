<?php
include_once 'user.php';
include_once 'userSession.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
  echo "hay sesion";
}else if(isset($_POST[''])){

}


 ?>

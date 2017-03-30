<?php 
session_start();
$_COOKIES['prestataire']=null;
unset($_COOKIES['prestataire']);
session_destroy();
header("Location:index.php");
 ?>
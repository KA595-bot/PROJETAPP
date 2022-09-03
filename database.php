<?php
session_start();
try{
    $dbd = new PDO('mysql:host=localhost;dbname=administrateur;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Erreur'.$e->getMessage());
}

?>
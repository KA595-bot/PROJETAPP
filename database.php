<?php
try{
    $dbd = new PDO('mysql:host=127.0.0.1;dbname=administration;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Erreur'.$e->getMessage());
}

?>
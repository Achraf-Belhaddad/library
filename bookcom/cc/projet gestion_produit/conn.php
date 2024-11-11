<?php 
try{
    $conn=new PDO('mysql:host=localhost;dbname=products','root','');
 
 }
 catch( Exception $e){
    die('Erreur : ' . $e->getMessage());
 }
 ?>
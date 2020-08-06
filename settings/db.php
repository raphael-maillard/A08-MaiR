<?php
// Init the parameters
$database = 'mysql:host=127.0.0.1:3308; dbname=a08-MaiR; charset=utf8';
$user = 'a08';
$pwd = 'mdp';

// Start the try catch to make a connection with db and enter the variables
// Recovery the code error if you don't connect
try {
    $connect = new PDO($database, $user, $pwd);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // print_r("Connexion réussi <br>");
}
catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

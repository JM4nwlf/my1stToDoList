<?php
//connexion à la base de donnée
$mysqli = new mysqli(
    "localhost",
    "root", 
    "", 
    "todo"
);

if($mysqli->connect_errno) {
    echo "Echec de la connexion avec MySQL : ". $mysqli->connect_error;
}


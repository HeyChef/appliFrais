<?php


function openDb(){
    $connexion = mysqli_connect("localhost", "root","AzertY!59000","assistance_situation");
    mysqli_set_charset($connexion, "utf8");
    if (mysqli_connect_errno()){
        echo "Connection failed : ".mysqli_connect_error();
        exit();
    }
    return $connexion;
}

function closeDb($connexion){
    mysqli_close($connexion);
}

?>
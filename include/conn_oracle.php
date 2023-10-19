<?php 

# Usuario que recibo desde el form que esta en index.php

$usuario = strtoupper ($_POST["usuario"]);

# Password que recibo desde el form que esta en index.php


$clave = md5($_POST["clave"]);


# Nombre de la base de datos a la cual me conecto


$base = "PMPROD10";


?>
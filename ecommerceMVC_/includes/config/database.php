<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'contraseña', 'ecommercemvc');

    if (!$db) {
        echo "Error, no se pudo conectar.";
        exit;
    }

    return $db;
}

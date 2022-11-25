<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'Matteiro-784569', 'ecommercemvc');

    if (!$db) {
        echo "Error, no se pudo conectar.";
        exit;
    }

    return $db;
}

<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'Eafit2022.', 'ecommerceMVC');

    if (!$db) {
        echo "Error, no se pudo conectar.";
        exit;
    }

    return $db;
}

<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'Eafit2022.', 'id19911287_ecommercemvc');

    if (!$db) {
        echo "Error, no se pudo conectar.";
        exit;
    }

    return $db;
}

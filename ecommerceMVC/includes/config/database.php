<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'id19911287_root', 'Matteiro-784569', 'id19911287_ecommercemvc');

    if (!$db) {
        echo "Error, no se pudo conectar.";
        exit;
    }

    return $db;
}

<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');


function incluirTemplate(string $nombre, bool $inicio = false): void
{
    include TEMPLATES_URL . "/${nombre}.php";
}

// Sanitizar HTML
function sanitizar($html)
{
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}

function validarRedireccionar(string $url)
{
    // Validar id valido
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id) {
        // Redireccionar usuario si el id dado no existe
        header("Location: ${url}");
    }

    return $id;
}

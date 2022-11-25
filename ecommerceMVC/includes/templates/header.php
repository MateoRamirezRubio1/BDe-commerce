<?php

$sesionIniciada = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
</head>

<body>
    <header>
        <div>
            <a href="/?categoria=-1">
                <h1>E-Commerce</h1>
            </a>

            <nav>
                <a href="">Iniciar Sesión</a>
                <?php if ($sesionIniciada) : ?>
                    <a href="#">Cerrar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
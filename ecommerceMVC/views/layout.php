<?php
if (!isset($_SESSION)) {
    session_start();
}

$sesionIniciada = $_SESSION['login'] ?? false;
$sesionIniciadaAdmin = $_SESSION['admin'] ?? false;
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

            <?php if ($sesionIniciada) {
                echo 'Bienvenido ' . $_SESSION['usuario'];
            }
            ?>

            <nav>
                <a href="/login">Iniciar Sesión</a>
                <?php if ($sesionIniciada) : ?>
                    <a href="/logout">Cerrar Sesión</a>
                    <?php if ($sesionIniciadaAdmin) : ?>
                        <br>
                        <br>
                        <a href="/admin">Administrar E-Commerce</a>
                        <br>
                        <a href="/clientes/compras?us=adm">Historial compras de clientes</a>
                    <?php endif; ?>
                    <br>
                    <br>
                    <a href="/carrito/compras">Historial de compras</a>
                <?php endif; ?>
                <br>
                <br>
                <a href="/carrito">Carrito de compras</a>
                <?php if (!$sesionIniciada) {
                    echo "Debes iniciar sesión para agregar productos al carrito.";
                } ?>
            </nav>
        </div>
    </header>

    <?php echo $contenido; ?>

</body>

</html>
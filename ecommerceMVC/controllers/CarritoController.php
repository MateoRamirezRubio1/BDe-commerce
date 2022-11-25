<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;
use Model\Producto;
use Model\Categorias;
use Model\Carrito;
use Model\Compra;

class CarritoController
{
    public static function carrito(Router $router)
    {
        session_start();
        $autenticado = $_SESSION['login'] ?? False;

        if ($autenticado) {
            $idEditar = $_GET['id'] ?? False;
            $idUsuario = intval(Carrito::idUsuario());

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Actualizar stock del producto cuando este es agregado al carrito
                $idProducto = $_POST['product_id'];
                $producto = Producto::buscar($idProducto);

                $actualizarStock = CarritoController::actualizarStock(False, $producto->stock);

                $producto->sincronizar($actualizarStock);

                $producto->guardar();

                // Agregar producto al carrito base de datos
                $_POST['customer_id'] = $idUsuario;
                $carrito = new Carrito($_POST);

                $carrito->guardar();
            }

            $productosCarrito = Carrito::productosCarrito($idUsuario);
            $totalCompra = 0;
        }
        if (!$autenticado) {
            header('Location: /');
        }

        $router->render('/paginas/carrito', [
            'productosCarrito' => $productosCarrito,
            'idEditar' => $idEditar,
            'totalCompra' => $totalCompra
        ]);
    }

    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['carrito']['id']);

            // Obtener datos del producto alojado en el carrito
            $productoCarrito = Carrito::buscar($id);

            $argumentos = $_POST['carrito'];

            $productoCarrito->sincronizar($argumentos);

            $productoCarrito->guardar();
        }

        header('Location: /carrito');
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // Actualizar stock del producto cuando este es eliminado del carrito
                $idProducto = intval($_POST['product_id']);
                $producto = Producto::buscar($idProducto);

                $actualizarStock = CarritoController::actualizarStock(True, $producto->stock);

                $producto->sincronizar($actualizarStock);

                $producto->guardar();

                // Eliminar producto del carrito
                $productoCarrito = Carrito::buscar($id);
                $productoCarrito->eliminar();
            }
        }

        header('Location: /carrito');
    }

    public static function comprar(Router $router)
    {
        $idUsuario = intval(Carrito::idUsuario());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idUsuario = intval(Carrito::idUsuario());
            $_POST['customer_id'] = $idUsuario;
            if (!$_POST['shipping_address']) {
                $_POST['shipping_address'] = 'Bodega principal';
            }

            $orden = new Compra($_POST);

            $orden->guardar();

            if ($orden) {
                Carrito::vaciarCarrito($idUsuario);
                header('Location: /');
            }
        }

        $ordenes = Compra::allCompras($idUsuario);
        $view = '/paginas/compras';
        if ($_GET['us'] === 'adm') {
            $ordenes = Compra::comprasClientes();
            $view = '/paginas/historialClientes';
        }
        $clientes = Admin::obtenerTodosIDUsuarios();
        $router->render($view, [
            'ordenes' => $ordenes,
            'clientes' => $clientes
        ]);
    }

    public static function actualizarStock($suma, $stockActual)
    {
        if ($suma) {
            $nuevoStock = $stockActual + intval($_POST['quantity']);
        }
        if (!$suma) {
            $nuevoStock = $stockActual - intval($_POST['quantity']);
        }

        $actualizarStock = [
            'id' => $_POST['product_id'],
            'stock' => $nuevoStock
        ];

        return $actualizarStock;
    }
}

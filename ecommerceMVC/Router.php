<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion)
    {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $autenticado = $_SESSION['admin'] ?? False;

        // Rutas protegidas
        $rutasProtegidas = ['/admin', '/productos/crear', '/productos/actualizar', '/productos/eliminar'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        }
        if ($metodo === 'POST') {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger rutas si un usuario no admin está ingresando
        if (in_array($urlActual, $rutasProtegidas) && !$autenticado) {
            header('Location: /public/index.php');
        }

        if ($funcion) {
            call_user_func($funcion, $this);
        } else {
            echo 'Página no encontrada';
        }
    }

    // Mostrar una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $clave => $valor) {
            $$clave = $valor;
        }

        ob_start();

        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}

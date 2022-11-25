<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $autenticacion = new Admin($_POST);

            $errores = $autenticacion->validarInicioUsuario();

            if (empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $autenticacion->existeUsuario();

                if (!$resultado) {
                    $errores = Admin::getErrores();
                }
                if ($resultado) {
                    // Verificar contraseña
                    $autenticado = $autenticacion->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar usuario
                        $autenticacion->autenticarUsuario();
                    }
                    if (!$autenticado) {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('/auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function register(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registrar = new Admin($_POST);

            $errores = $registrar->validarRegistro();

            if (empty($errores)) {
                $registrar->registrarUsuario();
            }
        }

        $router->render('/auth/register', [
            'errores' => $errores
        ]);
    }
}

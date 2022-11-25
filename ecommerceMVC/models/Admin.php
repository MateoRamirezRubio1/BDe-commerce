<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'customer';
    protected static $columnasDB = ['id', 'email', 'password', 'full_name', 'billing_address', 'default_shipping_address', 'country', 'phone'];

    public $id;
    public $email;
    public $password;
    public $full_name;
    public $billing_address;
    public $default_shipping_address;
    public $country;
    public $phone;
    public $admin;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->full_name = $args['full_name'] ?? '';
        $this->billing_address = $args['billing_address'] ?? '';
        $this->default_shipping_address = $args['default_shipping_address'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = 0;
    }

    public static function obtenerTodosIDUsuarios()
    {
        $query = "SELECT id, email FROM " . self::$tabla . " ORDER BY id ASC";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public function validarRegistro()
    {
        $atributos = $this->iterarAtributos();

        foreach ($atributos as $clave => $valor) {
            if (!$valor) {
                self::$errores[] = "El campo " . $clave . " es obligatorio.";
            }
        }

        return self::$errores;
    }

    public function validarInicioUsuario()
    {
        if (!$this->email) {
            self::$errores[] = "El campo Email es obligatorio.";
        }
        if (!$this->password) {
            self::$errores[] = "El campo Password es obligatorio.";
        }
        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisar si el usuario existe
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El Usuario ingresado no existe";
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = 'El Password es incorrecto';
            return;
        }
        return $autenticado;
    }

    public function autenticarUsuario()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Llenar el arreglo de la sesión
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = True;
        if ($this->email === 'root@root.com') {
            $_SESSION['admin'] = True;
        }
    }

    public function registrarUsuario()
    {
        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

        // Query para crear el usuario
        $query = "INSERT INTO customer (email, password, full_name, billing_address, default_shipping_address, country, phone, admin) VALUES ('{$this->email}', '${passwordHash}', '{$this->full_name}', '{$this->billing_address}', '{$this->default_shipping_address}', '{$this->country}', {$this->phone}, {$this->admin})";

        // Agregarlo a la base de datos
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /public/index.php/login');
        }
    }
}

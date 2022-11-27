<?php

namespace Model;

class ActiveRecord
{
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // Definir conexión a la base de datos
    public static function setDB($dataBase)
    {
        self::$db = $dataBase;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->iterarAtributos();
        $atributosSanitizados = [];

        foreach ($atributos as $llave => $valor) {
            $atributosSanitizados[$llave] = self::$db->escape_string($valor);
        }
        return $atributosSanitizados;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear nuevo registro
            $this->crear();
        }
    }

    public function crear()
    {
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        self::$db->query($query);
    }

    public function actualizar()
    {
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $clave => $valor) {
            if ($clave === 'name') {
                $admin = True;
            }
            $valores[] = "{$clave}='{$valor}'";
        }

        // Insertar en la base de datos
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        self::$db->query($query);
    }

    // Eliminar registro
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla;
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        self::$db->query($query);
    }

    public function iterarAtributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    // Validación campos
    public function validarCampos()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Listar todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Buscar un registro por su id
    public static function buscar($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $arrayAyuda = [];
        while ($registro = $resultado->fetch_assoc()) {
            $arrayAyuda[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $arrayAyuda;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $clave => $valor) {
            $objeto->$clave = $valor;
        }
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizador por el usuario al actualizar
    public function sincronizar($args = [])
    {
        foreach ($args as $clave => $valor) {
            if (property_exists($this, $clave) && !is_null($valor)) {
                $this->$clave = $valor;
            }
        }
    }

    public static function idUsuario()
    {
        $email = sanitizar($_SESSION['usuario']) ?? '';

        $query = "SELECT id FROM customer WHERE email = '${email}'";

        $resultado = self::consultarSQL($query);

        return $resultado[0]->id;
    }
}

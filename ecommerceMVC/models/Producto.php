<?php

namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'product';
    protected static $columnasDB = ['id', 'sku', 'name', 'price', 'description', 'create_data', 'stock', 'category_id'];

    public $id;
    public $sku;
    public $name;
    public $price;
    public $description;
    public $create_data;
    public $stock;
    public $category_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->sku = $args['sku'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->create_data = date('Y/m/d');
        $this->stock = $args['stock'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
    }

    // Validación campos
    public function validarCampos()
    {
        $atributos = $this->iterarAtributos();

        foreach ($atributos as $clave => $valor) {
            if ($clave === 'descripcion' && strlen($valor) < 30) {
                self::$errores[] = "El campo " . $clave . " es de mínimo 30 caracteres.";
            }
            if ($clave !== 'descripcion' && !$valor) {
                self::$errores[] = "El campo " . $clave . " es obligatorio.";
            }
        }
        return self::$errores;
    }

    public static function aplicarFiltros($filtrados = [], $orden = '')
    {
        $filtros = [
            "categoria" => " category_id = " . $filtrados['categoria'],
            "buscar" => " name LIKE '%" . $filtrados['buscar'] . "%'",
            "precio" => " price >= " . intval($filtrados['precio'][0]) . " AND price <= " . intval($filtrados['precio'][1])
        ];

        $query = "SELECT * FROM " . self::$tabla;

        $contador = 0;
        foreach ($filtrados as $clave => $valor) {
            if ($valor != '' && $valor != -1) {
                if ($contador === 1) {
                    $query .= " AND";
                }
                if ($contador === 0) {
                    $query .= " WHERE ";
                    $contador = 1;
                }
                $query .= $filtros[$clave];
            }
        }

        if ($orden === 'des') {
            $query .= " ORDER BY price DESC";
        }
        if ($orden === 'asc') {
            $query .= " ORDER BY price ASC";
        }

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
}

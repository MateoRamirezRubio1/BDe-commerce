<?php

namespace Model;

class Compra extends ActiveRecord
{
    protected static $tabla = 'orders';
    protected static $columnasDB = ['id', 'ammount', 'shipping_address', 'order_date', 'order_status', 'customer_id'];

    public $id;
    public $ammount;
    public $shipping_address;
    public $order_date;
    public $order_status;
    public $customer_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->ammount = $args['ammount'] ?? '';
        $this->shipping_address = $args['shipping_address'] ?? 'Bodega principal';
        $this->order_date = date('Y/m/d');
        $this->order_status = 'Activo en bodega';
        $this->customer_id = $args['customer_id'] ?? '';
    }

    public static function allCompras($idUsuario)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE customer_id = " . $idUsuario;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function comprasClientes()
    {
        $query = "SELECT " . self::$tabla . ".*, customer.email FROM " . self::$tabla . " INNER JOIN customer ON " . self::$tabla . ".customer_id = customer.id ORDER BY customer_id ASC";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
}

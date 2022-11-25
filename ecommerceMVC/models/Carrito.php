<?php

namespace Model;

if (!isset($_SESSION)) {
    session_start();
}

class Carrito extends ActiveRecord
{
    protected static $tabla = 'order_details';
    protected static $columnasDB = ['id', 'quantity', 'product_id', 'customer_id'];

    public $id;
    public $quantity;
    public $product_id;
    public $customer_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->quantity = $args['quantity'] ?? 1;
        $this->product_id = $args['product_id'] ?? '';
        $this->customer_id = $args['customer_id'] ?? '';
    }

    public static function productosCarrito($idUsuario)
    {
        $query = "SELECT " . self::$tabla . ".id, quantity, product_id, sku, name, price FROM " . self::$tabla . " INNER JOIN product ON " . self::$tabla . ".product_id = product.id WHERE customer_id = " . $idUsuario;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function vaciarCarrito($idUsuario)
    {
        $query = "DELETE FROM " . self::$tabla . " WHERE customer_id = " . $idUsuario;

        self::$db->query($query);
    }
}

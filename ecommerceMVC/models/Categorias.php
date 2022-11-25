<?php

namespace Model;

class Categorias extends ActiveRecord
{
    protected static $tabla = 'category';
    protected static $columnasDB = ['id', 'name', 'description'];

    public $id;
    public $name;
    public $description;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
    }
}

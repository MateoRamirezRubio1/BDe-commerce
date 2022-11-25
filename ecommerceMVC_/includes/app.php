<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarse a la base de datos
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);

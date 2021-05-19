<?php

namespace App\Models;

use App\database\Database;

class Product extends Database
{
    public $table = 'products';

    public $fillable = [
        'title', 'description', 'price'
    ];
}
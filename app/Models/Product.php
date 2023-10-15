<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // You will not need to use this property if you commit with laravel standard

    // TIMESTAMP COLUMNS and you can change this defalt name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $connection = 'mysql';
    protected $table = 'stores';
    protected $primaryKey = 'id'; // auto_increment by default in laravel 

    // to change auto_increment in laravel (true is default)
    // this and $timestamp the only property that will be public
    public $incrementing = true;

    // Laravel always suppose that ur table have timestamps() even if you deleted it 
    // so you can do set this
    public $timestamps = true;
}

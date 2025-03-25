<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Esto permite que se llenen estos campos al crear una categoría
    protected $fillable = ['name'];
}
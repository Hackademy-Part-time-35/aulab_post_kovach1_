<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Category extends Model
{
    use HasFactory;

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['name'];

    // Relación: Una categoría tiene muchos artículos
    public function articles(){
        return $this->hasMany(Article::class);
    }
}


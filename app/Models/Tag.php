<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['name'];

    // Relación: Un tag puede estar asociado a muchos artículos
    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}


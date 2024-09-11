<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_revisor',
        'is_writer'
    ];

    // Define los atributos que deben permanecer ocultos cuando el modelo es serializado
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define los atributos que deben ser convertidos a un tipo de dato específico
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',  // Indica que el campo 'password' será almacenado como un hash
        ];
    }

    // Relación: Un usuario puede tener muchos artículos
    public function articles(){
        return $this->hasMany(Article::class);
    }
}

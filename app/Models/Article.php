<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable, HasFactory;

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['title', 'subtitle', 'body', 'image', 'user_id', 'category_id', 'is_accepted', 'slug'];

    // Relación: Un artículo pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relación: Un artículo pertenece a una categoría
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relación: Un artículo puede tener varios tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // Calcula la duración estimada de lectura basada en la cantidad de palabras
    public function readDuration(){
        $totalWords = Str::wordCount($this->body);
        $minutesToRead = round($totalWords / 200);
        return intval($minutesToRead);
    }

    // Define que la clave de búsqueda en las rutas es el slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Define cómo se verá el artículo en una búsqueda
    public function toSearchableArray(){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'category' => $this->category,
        ];
    }
}

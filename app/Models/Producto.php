<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'codigo_producto',
        'descripcion',
        'stock',
        'id_unidad',
        'id_categoria',
        'imagen',
        'activo',
    ];

    public function categorias() {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function unidades() {
        return $this->belongsTo(Unidad::class, 'id_unidad');
    }

    public function imagen() {
        return $this->hasOne(ProductosImagen::class);
    }
}

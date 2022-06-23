<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosImagen extends Model
{
    use HasFactory;

    protected $table = 'producto_images';

    protected $fillable = [
        'id_producto',
        'imagen'
    ];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }
}

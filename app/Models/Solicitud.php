<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $primaryKey = 'codigo_solicitud';
    protected $fillable =  [
        'id_solicitud',
        'id_usuario',
        'id_estatus',
        'num_productos',
        'created_at',
        'updated_at',
    ];

    public function usuarios(){
        return $this->belongsTo(User::class);
    }

    public function detalle_solicitud(){
        return $this->belongsToMany(Producto::class, 'detalle_solicitudes','codigo_solicitud','id_producto');
    }
}

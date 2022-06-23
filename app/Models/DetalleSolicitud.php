<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    use HasFactory;

    protected $table = 'detalle_solicitudes';
    protected $primaryKey = 'id';
    protected $fillable =  [
        'codigo_solicitud',
        'id_producto',
        'cantidad',
        'created_at',
        'updated_at',
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function solicitud() {
        return $this->belongsTo(Solicitud::class, );
    }
}

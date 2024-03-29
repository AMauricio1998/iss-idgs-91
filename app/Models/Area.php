<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
 
    protected $table = 'areas';

    protected $fillable = ['nombre_area', 'clave', 'descripcion'];

    public function user() {
        return $this->hasMany(User::class);
    }
}

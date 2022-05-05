<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $table = 'tipoCliente';
    use HasFactory;
    

    public $timestamps = false;

    protected $fillable = [
        'tipoCliente'

    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

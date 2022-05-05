<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
   
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'email',
        'imagem'

    ];

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    public function tipoCliente()
    {
        return $this->hasOne(TipoCliente::class);
    }

    public function vendedores()
    {
        return $this->belongsToMany(Vendedor::class);
    }
    
}

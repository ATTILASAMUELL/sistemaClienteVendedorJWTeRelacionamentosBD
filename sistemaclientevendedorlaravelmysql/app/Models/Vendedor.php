<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedor';
    
    protected $fillable = [
        'nome'
    ];
    use HasFactory;
    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
    
}

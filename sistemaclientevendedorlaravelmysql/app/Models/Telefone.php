<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'telefone';
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'telefone'

    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

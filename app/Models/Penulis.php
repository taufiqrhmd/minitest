<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Penulis extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_penulis';

    protected $fillable = [
        'id_penulis',
        'username',
        'password',
        'status'
    ];
    protected $hidden = [
        'password'
    ];
    protected $primaryKey = 'id_penulis';

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'id_penulis');
    }
}

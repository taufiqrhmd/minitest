<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_admin';

    protected $fillable = [
        'id_admin',
        'username',
        'password'
    ];
    protected $hidden = [
        'password'
    ];
    protected $primaryKey = 'id_admin';
}

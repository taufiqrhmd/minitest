<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'tb_detail';

    protected $fillable = [
        'id_komentar',
        'id_artikel',
        'created_at',
        'updated_at'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }

    public function komentar()
    {
        return $this->belongsTo(Komentar::class, 'id_komentar');
    }
}

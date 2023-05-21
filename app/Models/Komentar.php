<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'tb_komentar';

    protected $primaryKey = 'id_komentar';
    protected $fillable = [
        'id_komentar',
        'nama',
        'isi_komentar',
        'email',
        'created_at',
        'updated_at'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel', 'id');
    }

    public function artikelDetail()
    {
        return $this->belongsToMany(Artikel::class, 'tb_detail', 'id_komentar', 'id_artikel');
    }
}

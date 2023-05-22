<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'tb_artikel';

    protected $fillable = [
        'id_artikel',
        'judul',
        'isi_artikel',
        'tanggal',
        'id_penulis'
    ];

    protected $hidden = [
        'password'
    ];
    protected $primaryKey = 'id_artikel';

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis');
    }

    public function komentar()
    {
        return $this->belongsToMany(Komentar::class, 'tb_detail', 'id_artikel', 'id_komentar');
    }

}

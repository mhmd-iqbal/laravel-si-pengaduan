<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'no_pengaduan';
    public $incrementing = false;
    // protected $guarded = ['no_pengaduan'];

    protected $fillable = [
        'no_pengaduan',
        'judul',
        'user_id',
        'kategori_id',
        'isi',
        'gambar',
        'status',
        'tanggapan'
    ];

    protected $with = ['kategori', 'user'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return "no_pengaduan";
    }
}

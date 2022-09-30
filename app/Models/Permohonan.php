<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
  use HasFactory;

  protected $table = 'permohonan';
  // private $guarded = ['id'];
  protected $primaryKey = 'no_permohonan';
  public $incrementing = false;

  protected $fillable = [
    'no_permohonan',
    'kode_pengaduan',
    'judul',
    'user_id',
    'isi',
    'status',
    'tanggapan',
  ];

  protected $with = ['user', 'pengaduan'];

  public function pengaduan()
  {
    return $this->belongsTo(Pengaduan::class, 'kode_pengaduan', 'no_pengaduan', 'cascade');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getRouteKeyName()
  {
    return "no_permohonan";
  }
}

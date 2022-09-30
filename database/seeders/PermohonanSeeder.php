<?php

namespace Database\Seeders;

use App\Models\Permohonan;
use Illuminate\Database\Seeder;

class PermohonanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Permohonan::create([
      'no_permohonan'   => 'M-' . date('ymdhis') . mt_rand(2, 100),
      'kode_pengaduan' => 'A-22062511372469',
      'judul' => 'Keyboard baru',
      'user_id'   => 5,
      'isi' => 'Kami membutuhkan keyboard baru untuk stock simpanan di bagian teknisi, apakah barangnya sudah ada?',
      'status' => 'Menunggu tanggapan',
    ]);

    Permohonan::create([
      'no_permohonan'   => 'M-' . date('ymdhis') . mt_rand(2, 100),
      'kode_pengaduan' => 'A-22062511372470',
      'judul' => 'Mouse Wireless baru',
      'user_id'   => 4,
      'isi' => 'Kami membutuhkan mouse wireless baru segera mungkin, apakah barangnya sudah ada?',
      'status' => 'Menunggu tanggapan',
    ]);
  }
}

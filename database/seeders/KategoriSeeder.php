<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'slug' => 'elektronik-hardware',
            'nama_kategori' => 'Elektronik & Hardware',
        ]);

        Kategori::create([
            'slug' => 'maintenance',
            'nama_kategori' => 'Maintenance',
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->string('no_pengaduan', 20);
            $table->primary('no_pengaduan');
            $table->string('judul', 30);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kategori_id');
            $table->text('isi');
            $table->string('gambar', 255)->nullable();
            $table->enum('status', ['Menunggu konfirmasi', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu konfirmasi');
            $table->text('tanggapan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('kategori_id')->references('id')->on('kategori')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}

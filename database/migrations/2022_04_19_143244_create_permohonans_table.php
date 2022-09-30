<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('permohonan', function (Blueprint $table) {
      $table->string('no_permohonan', 20);
      $table->primary('no_permohonan');
      $table->string('kode_pengaduan', 20);
      $table->string('judul', 50);
      $table->unsignedBigInteger('user_id');
      $table->text('isi');
      $table->string('status')->default('Menunggu tanggapan');
      $table->text('tanggapan')->nullable();
      $table->timestamps();

      $table->foreign('kode_pengaduan')->references('no_pengaduan')->on('pengaduan')->cascadeOnDelete();
      $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('permohonan');
  }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_presensi');
            $table->time('jam_in');
            $table->time('jam_out');
            $table->string('gambar_in');
            $table->string('gambar_out');
            $table->string('location_in');
            $table->string('location_out');
            $table->string('keterangan', 50);
            $table->string('employees_id', 25);
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penjualan', function (Blueprint $table) {
        $table->increments('PenjualanID');
        $table->date('TanggalPenjualan');
        $table->decimal('TotalHarga', 10, 2);
        $table->unsignedInteger('PelangganID');
        $table->foreign('PelangganID')->references('PelangganID')->on('pelanggan')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};

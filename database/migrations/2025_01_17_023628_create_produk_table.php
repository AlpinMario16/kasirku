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
    Schema::create('produk', function (Blueprint $table) {
        $table->unsignedInteger('ProdukID')->unique(); // Sesuaikan dengan pembelian
        $table->string('KodeProduk')->unique();
        $table->string('NamaProduk', 255);
        $table->string('Kategori', 255);
        $table->decimal('Harga', 10, 2);
        $table->integer('Stok');
        $table->string('GambarProduk')->nullable(); // Menambahkan gambar produk (nullable jika tidak selalu ada gambar)
        $table->unsignedBigInteger('id_supplier')->nullable(); // Menambahkan id_supplier
        $table->timestamps();

        // Menambahkan foreign key constraint untuk id_supplier
        $table->foreign('id_supplier')->references('id_supplier')->on('supplier')->onDelete('set null');
    });
}

    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

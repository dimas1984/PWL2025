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
        Schema::create('t_stock', function (Blueprint $table) {

                $table->id('stock_id');
                $table->unsignedBigInteger('barang_id')->index();
                $table->unsignedBigInteger('user_id')->index();
                $table->dateTime('stock_tanggal');
                $table->unsignedBigInteger('stock_jumlah');
                $table->timestamps();

                //mendefinisikan FK pada kolom level_id mengacu pada kolom level_id di tabel m_level
                $table->foreign('user_id')->references('user_id')->on('m_user');
                $table->foreign('barang_id')->references('barang_id')->on('m_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stock');
    }
};

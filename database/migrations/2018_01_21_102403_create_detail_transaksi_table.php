<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->string('id_transaksi', 10);
            $table->string('id_produk', 10);
            $table->integer('qty');
//            $table->unique(array('id_transaksi', 'id_produk'));
//            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksis')->onDelete('cascade');
//            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}

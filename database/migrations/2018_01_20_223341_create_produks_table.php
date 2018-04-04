<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->string('nama_produk', 150);
            $table->integer('id_satuan');
            $table->string('harga_beli', 15);
            $table->string('harga_jual', 15);
            $table->integer('stok');
//            $table->unique(['id_satuan']);
//            $table->foreign('id_satuan')->references('id_satuan')->on('satuans')->onDelete('cascade');
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
        Schema::dropIfExists('produks');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_distributor')->default(null);
            $table->integer('id_pelanggan')->default(null);
            $table->string('type', 2)->default('0');
            $table->datetime('tgl_transaksi');
            $table->string('total_harga', 50)->default(0);

            $table->string('biaya_kirim', 50)->default(0);
            $table->string('grand_total', 50)->default(0);
//            $table->unique(array('id_pelanggan', 'id_distributor'));
//            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
//            $table->foreign('id_distributor')->references('id_distributor')->on('distributors')->onDelete('cascade');
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
        Schema::dropIfExists('transaksis');
    }
}

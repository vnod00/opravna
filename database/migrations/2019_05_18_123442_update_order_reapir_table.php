<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderReapirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_repair', function (Blueprint $table) {
            $table->bigInteger('ord_id')->unsigned();
            $table->bigInteger('rep_id')->unsigned();
            $table->foreign('ord_id')->references('ord_id')->on('orders')->onDelete('cascade');
            $table->foreign('rep_id')->references('rep_id')->on('repairs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_repair');
    }
}

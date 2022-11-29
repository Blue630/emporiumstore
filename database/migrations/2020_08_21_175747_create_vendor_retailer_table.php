<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRetailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_retailer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unquie();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('confirmpass')->nullable();
            $table->string('storename')->nullable();
            $table->string('address')->nullable();
            $table->integer('user_type')->nullable();
            $table->string('adharcarimg')->nullable();
            $table->string('pancardimg')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_retailer');
    }
}

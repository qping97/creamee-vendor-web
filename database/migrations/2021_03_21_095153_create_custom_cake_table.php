<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomCakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_cake', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shape');
            $table->string('description');
            $table->string('customize_text');
            $table->string('image');
            $table->unsignedInteger('flavor_id');
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('customer_id');
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
        Schema::dropIfExists('custom_cake');
    }
}

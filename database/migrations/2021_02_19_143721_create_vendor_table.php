<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_name');
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('vendor_address');
            $table->string('image');
            $table->string('profile_img');
            $table->string('registration_no')->unique();
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->timestamp('email_verified_at')->nullable();       
            $table->rememberToken();
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
        Schema::dropIfExists('vendor');
    }
}

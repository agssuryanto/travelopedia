<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserInfoPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info_personals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('id_card')->unique();
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('address1');
            $table->string('address2');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('district_id');
            $table->integer('subdistrict_id');
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
        Schema::dropIfExists('user_info_personals');
    }
}

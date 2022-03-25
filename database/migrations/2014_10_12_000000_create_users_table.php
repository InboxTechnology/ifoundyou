<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('original_password')->nullable();
            $table->string('sex')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('year')->nullable();
            $table->integer('datepoint')->nullable();
            $table->string('phone')->nullable();
            $table->string('bodytype')->nullable();
            $table->string('height')->nullable();
            $table->string('eyecolor')->nullable();
            $table->string('haircolor')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('language')->nullable();
            $table->string('religion')->nullable();
            $table->string('about_gender')->nullable();
            $table->string('about_bodytype')->nullable();
            $table->string('about_height')->nullable();
            $table->string('about_eyecolor')->nullable();
            $table->string('about_haircolor')->nullable();
            $table->string('about_ethnicity')->nullable();
            $table->string('about_language')->nullable();
            $table->string('about_religion')->nullable();
            $table->string('state')->nullable();
            $table->string('live_in')->nullable();
            $table->string('activity')->nullable();
            $table->string('type_of_relationship')->nullable();
            $table->string('chinese_sign')->nullable();
            $table->string('western_sign')->nullable();
            $table->string('cafe')->nullable();
            $table->string('status')->nullable();
            $table->string('account_setup')->nullable();
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
        Schema::dropIfExists('users');
    }
}

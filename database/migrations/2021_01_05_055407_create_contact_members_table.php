<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from_id')->unsigned();
            $table->string('user_to_id_number');
            $table->string('choose_message')->nullable();
            $table->text('description')->nullable();

            $table->foreign('user_from_id')->references('id')->on('users');
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
        Schema::dropIfExists('contact_members');
    }
}

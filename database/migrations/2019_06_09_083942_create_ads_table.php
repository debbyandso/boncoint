<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('localisation');
            $table->integer('price');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unsigned();
            //pourquoi unsigned: The thing is the ID field of parent table was built with
            // $table->increments('id');, which is, by default UNSIGNED. So, basically, you
            // cannot build foreign key from signed field to 
            //a table with an unsigned ID field.
            //cascade: quand un utilisateur sera supprimé, ces annonces n'apparaitront plus
            //user id est une cle etrange qui aura une une reference id(champs) de la table users 
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
        Schema::dropIfExists('ads');
    }
}

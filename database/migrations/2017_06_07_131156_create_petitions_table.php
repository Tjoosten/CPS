<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('author_id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        // Categories relationship table.
        Schema::create('categories_petitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('petitions_id');
            $table->integer('categories_id');
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
        Schema::dropIfExists('petitions');
        Schema::dropIfExists('categories_petitions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juzs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('juz_name')->nullable();
            $table->string('juz_number')->nullable();
            $table->integer('start_surah_id')->nullable();
            $table->integer('start_verse_id')->nullable();
            $table->integer('end_surah_id')->nullable();
            $table->integer('end_verse_id')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('juzs');
    }
}

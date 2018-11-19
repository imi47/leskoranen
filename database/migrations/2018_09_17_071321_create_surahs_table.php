<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surah_name')->nullable();
            $table->string('surah_name_arabic')->nullable();
            $table->integer('type_id')->nullable()->comment = "1 = Makki , 2 = Madani";
            $table->integer('surah_number')->default(0);
            $table->integer('juz_id')->default(0);
            $table->integer('hizb')->nullable();
            $table->integer('raku')->default(0);
            $table->integer('verses')->default(0);
            $table->text('introduction')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('surahs');
    }
}

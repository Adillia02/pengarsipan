<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersyaratanAktaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements_deed', function (Blueprint $table) {
            $table->id();
            $table->integer('attendees_id');
            $table->integer('deed_id');
            $table->integer('requirement_id');
            $table->string('file');
            $table->integer('created_id');
            $table->integer('updated_id');
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
        Schema::dropIfExists('requirements_deed');
    }
}

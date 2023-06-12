<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktaKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoing_deeds', function (Blueprint $table) {
            $table->id();
            $table->integer('deed_id');
            $table->string('name');
            $table->string('no_ktp');
            $table->string('telephone');
            $table->date('date_of_release');
            $table->string('quantity');
            $table->text('description')->nullable();
            $table->boolean('new_status_deed');
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
        Schema::dropIfExists('outgoing_deeds');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deeds', function (Blueprint $table) {
            $table->id();
            $table->integer('business_entity_id');
            $table->integer('deed_type_id');
            $table->string('deed_number');
            $table->date('deed_date');
            $table->string('business_name');
            $table->string('address');
            $table->string('deed_draft');
            $table->string('deed_copy');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('deeds');
    }
}

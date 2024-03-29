<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pergunta_temporarias', function (Blueprint $table) {
            $table->id();
            $table->string('referencia_enquete');
            $table->text('pergunta');
            $table->integer('voto')->default(0);
            $table->integer('total_alternativa')->default(0);
            $table->integer('modelo_id');
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
        Schema::dropIfExists('pergunta_temporarias');
    }
};

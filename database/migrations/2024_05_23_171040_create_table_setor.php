<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome')->nullable(false);
            $table->uuid('tipo_setor_id')->nullable(false);
            $table->foreign('tipo_setor_id')->references('id')->on('tipo_setor');
            $table->uuid('empresa_id')->nullable(false);
            $table->foreign('empresa_id')->references('id')->on('empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setor', function (Blueprint $table){
            $table->dropForeign(['tipo_setor_id']);
            $table->dropForeign(['empresa_id']);
        });  
        Schema::dropIfExists('setor');
    }
};

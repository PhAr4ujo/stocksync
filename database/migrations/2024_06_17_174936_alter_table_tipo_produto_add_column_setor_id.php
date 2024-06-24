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
        Schema::table('tipo_produto', function(Blueprint $table){
            $table->uuid('setor_id')->nullable('false');
            $table->foreign('setor_id')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_produto', function(Blueprint $table){
            $table->dropForeign('setor_id');
        });
    }
};

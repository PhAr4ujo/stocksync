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
        Schema::create('produto', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome')->nullable(false);
            $table->double('preco')->nullable(false);
            $table->uuid('tipo_produto_id')->nullable(false);
            $table->foreign('tipo_produto_id')->references('id')->on('tipo_produto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto', function (Blueprint $table){
            $table->dropForeign(['tipo_produto_id']);
        });
        Schema::dropIfExists('produto');
    }
};

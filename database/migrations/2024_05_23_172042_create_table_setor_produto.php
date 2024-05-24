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
        Schema::create('setor_produto', function (Blueprint $table) {
            $table->uuid('setor_id')->nullable(false);
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->uuid('produto_id')->nullable(false);
            $table->foreign('produto_id')->references('id')->on('produto');
            $table->unsignedInteger('quantidade');
            $table->timestamps();
            $table->primary(['setor_id', 'produto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setor_produto', function (Blueprint $table){
            $table->dropForeign(['setor_id']);
            $table->dropForeign(['produto_id']);
            $table->dropPrimary(['setor_id', 'produto_id']);
        });      
        Schema::dropIfExists('setor_produto');
    }
};

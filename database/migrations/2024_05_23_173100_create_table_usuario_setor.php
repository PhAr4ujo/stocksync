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
        Schema::create('usuario_setor', function (Blueprint $table) {
            $table->uuid('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('setor_id')->nullable(false);
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->uuid('permissao_id')->nullable(false);
            $table->foreign('permissao_id')->references('id')->on('permissao');
            $table->primary(['user_id', 'setor_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_setor', function (Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['setor_id']);
            $table->dropForeign(['permissao_id']);
            $table->dropPrimary(['user_id', 'setor_id']);
        });
        Schema::dropIfExists('usuario_setor');
    }
};

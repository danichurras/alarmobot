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
        Schema::create('ativacaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('data_ativacao');
            $table->dateTime('data_desativacao')->nullable();
            $table->boolean('disparo')->default(false);
            $table->foreignId('alarme_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativacaos');
    }
};

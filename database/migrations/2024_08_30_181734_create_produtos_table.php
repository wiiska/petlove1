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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('nome');
            $table->float('valor');
            $table->float('qtd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};

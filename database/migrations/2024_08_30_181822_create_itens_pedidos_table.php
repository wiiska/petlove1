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
        Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id'); // Coluna para o ID do produto
            $table->unsignedBigInteger('pedido_id'); // Coluna para o ID do pedido
            $table->integer('qtd'); // Coluna para a quantidade

            // Chaves estrangeiras
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itens_pedidos', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropForeign(['pedido_id']);
        });

        Schema::dropIfExists('itens_pedidos');
    }
};

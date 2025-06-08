<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     *
     * @return void
     */
    public function up(): void
    {
        // Primeiro, CRIAMOS a tabela 'gateways' APENAS SE ELA NÃO EXISTIR.
        // Isso resolve o erro "Table not found" em definitivo.
        if (!Schema::hasTable('gateways')) {
            Schema::create('gateways', function (Blueprint $table) {
                $table->id();
                // Adicione aqui outras colunas que você possa precisar na criação inicial.
                $table->timestamps();
            });
        }

        // AGORA, com 100% de certeza que a tabela existe, nós a modificamos
        // para garantir que as colunas 'ativo' e 'nome' existam.
        Schema::table('gateways', function (Blueprint $table) {
            // Adiciona a coluna 'ativo' somente se ela ainda não existir.
            if (!Schema::hasColumn('gateways', 'ativo')) {
                $table->boolean('ativo')->default(false)->after('id');
            }

            // Adiciona a coluna 'nome' somente se ela ainda não existir.
            if (!Schema::hasColumn('gateways', 'nome')) {
                $table->string('nome')->nullable()->after('ativo');
            }
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down(): void
    {
        // Para reverter, apenas removemos as colunas, caso elas existam.
        // É mais seguro do que remover a tabela inteira.
        Schema::table('gateways', function (Blueprint $table) {
            if (Schema::hasColumn('gateways', 'ativo')) {
                $table->dropColumn('ativo');
            }
            if (Schema::hasColumn('gateways', 'nome')) {
                $table->dropColumn('nome');
            }
        });
    }
};


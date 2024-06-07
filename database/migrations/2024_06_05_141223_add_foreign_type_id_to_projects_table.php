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
        Schema::table('projects', function (Blueprint $table) {
            //
            //1. aggiungi la colonna
            $table->unsignedBigInteger('type_id')->nullable();
            //definendo il vincollo fra le due colonne delle tabelle
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            
            //2 rimuovi il vincolo 
            $table->dropForeign('projects_type_id_foreign');
            //1 rimuoviamo la colonna 
            $table->dropColumn('type_id');

        }); 
    }
};

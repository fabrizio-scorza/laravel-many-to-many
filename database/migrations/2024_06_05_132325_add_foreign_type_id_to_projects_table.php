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
            //aggiungo la colonna della chiave esterna dopo l'id
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // creo il vincolo tra le due tabelle e gestisco l'eventualità di elimazione del tipo
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // rimuovo il vincolo
            $table->dropForeign(['type_id']);
            // rimuovo la colonna
            $table->dropColumn('type_id');
        });
    }
};

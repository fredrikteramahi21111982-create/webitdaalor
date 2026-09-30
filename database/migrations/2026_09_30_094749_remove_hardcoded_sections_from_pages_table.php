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
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi', 'tujuan', 'sasaran', 'tugas_pokok']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('tujuan')->nullable();
            $table->longText('sasaran')->nullable();
            $table->longText('tugas_pokok')->nullable();
        });
    }
};

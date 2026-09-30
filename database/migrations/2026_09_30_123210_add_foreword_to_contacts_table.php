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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('foreword_title')->nullable()->default('Sekapur Sirih');
            $table->string('foreword_name')->nullable()->default('Romelus Djobo, SE');
            $table->string('foreword_position')->nullable()->default('Inspektur Daerah Kab. Alor');
            $table->text('foreword_content')->nullable();
            $table->string('foreword_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
};

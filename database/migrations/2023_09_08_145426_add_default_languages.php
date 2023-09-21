<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "INSERT INTO languages (locale) VALUES ('it'),('en')"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

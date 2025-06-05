<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::table('course', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('description'); // Tambahkan kolom thumbnail
        });
    }

    public function down(): void {
        Schema::table('course', function (Blueprint $table) {
            $table->dropColumn('thumbnail'); // Hapus kolom thumbnail jika rollback
        });
    }
};

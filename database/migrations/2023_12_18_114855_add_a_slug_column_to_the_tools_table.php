<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tools', static function (Blueprint $table) {
            $table->string('slug', 50)->unique()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('tools', static function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

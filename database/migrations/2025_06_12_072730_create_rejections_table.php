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
        Schema::create('rejections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BookCard::class)->constrained()->onDelete('cascade');
            $table->foreignId('rejected_by')->constrained(table: 'users', column: 'id')->onDelete('cascade');
            $table->tinyText('reason');
            $table->timestamp('rejected_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejections');
    }
};

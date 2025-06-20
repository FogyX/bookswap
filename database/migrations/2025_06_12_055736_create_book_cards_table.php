<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Models\User::class)->constrained()->onDelete('cascade');
            $table->string('author');
            $table->string('title');
            $table->foreignIdFor(Models\CardType::class)->constrained();
            $table->foreignIdFor(Models\Status::class)->constrained();
            $table->string('publisher')->nullable();
            $table->unsignedSmallInteger('publication_year')->nullable();
            $table->foreignIdFor(Models\CoverType::class)->nullable()->constrained();
            $table->foreignIdFor(Models\BookCondition::class)->nullable()->constrained();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_cards');
    }
};

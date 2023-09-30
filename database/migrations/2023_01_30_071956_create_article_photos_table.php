<?php

use App\Enums\TablesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create(TablesEnum::ARTICLES_PHOTOS->value, function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_id')
                ->constrained(TablesEnum::ARTICLES->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
            $table->string('photo');
            $table->string('relative_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists(TablesEnum::ARTICLES_PHOTOS->value);
    }
};

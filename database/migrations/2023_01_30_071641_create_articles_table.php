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
        Schema::create(TablesEnum::ARTICLES->value, function (Blueprint $table) {
            $table->id();
            $table->morphs('author');
            $table->string('title', 120);
            $table->string('slug', 255)->unique();
            $table->text('body');
            $table->foreignId('category_id')
                ->constrained(TablesEnum::CATEGORIES->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('thumbnail');
            $table->integer('likes')->default(0);
            $table->enum('status', [
                'drafted',
                'archived',
                'proposed',
                'published',
            ])->default('drafted');
            $table->string('banner_path')->nullable();
            $table->string('banner_relative_path')->nullable();
            $table->boolean('has_comments')
                ->default(false);
            $table->integer('downvotes_r')
                ->default(0);
            $table->integer('upvotes_r')
                ->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('will_be_published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists(TablesEnum::ARTICLES->value);
    }
};

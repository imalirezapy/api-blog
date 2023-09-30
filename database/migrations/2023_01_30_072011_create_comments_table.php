<?php

use App\Enums\CommentStatusesEnum;
use App\Enums\TablesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TablesEnum::COMMENTS->value, function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')
                ->constrained(TablesEnum::ARTICLES->value)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->morphs('author');
            $table->morphs('replied_to');
            $table->text('body');
            $table->enum('status', CommentStatusesEnum::values())
                ->default(CommentStatusesEnum::PENDING->value);
            $table->foreignId('parent_id')
                ->constrained(TablesEnum::COMMENTS->value)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('downvotes_r')->default(0);
            $table->unsignedInteger('upvotes_r')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TablesEnum::COMMENTS->value);
    }
};

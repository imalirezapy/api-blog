<?php

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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('body', 700);

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('comments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();;

            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};

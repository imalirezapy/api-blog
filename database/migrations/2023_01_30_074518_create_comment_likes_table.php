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
        Schema::create('comment_likes', function (Blueprint $table) {

            $table->foreignId('comment_id')->constrained('comments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->primary(['comment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
};

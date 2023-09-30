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
     * @return void
     */
    public function up()
    {
        Schema::create(TablesEnum::BLOG_VOTES->value, function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained(TablesEnum::USERS->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('votable_id');
            $table->string('votable_type');
            $table->index(['votable_id', 'votable_type']);

            $table->primary([
                'user_id',
                'votable_id',
                'votable_type'
            ]);

            $table->boolean('vote');

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
        Schema::dropIfExists(TablesEnum::BLOG_VOTES->value);
    }
};

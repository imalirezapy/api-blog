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
        Schema::create(TablesEnum::CATEGORIES->value, function (Blueprint $table) {
            $table->id();
            $table->string('name', 70)->unique();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained(TablesEnum::CATEGORIES->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists(TablesEnum::CATEGORIES->value);
    }
};

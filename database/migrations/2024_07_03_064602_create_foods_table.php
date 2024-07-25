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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('name')->comment('食品名');
            $table->string('short_name')->comment('略称');
            $table->float('calorie')->unsigned()->comment('カロリー kcal');
            $table->float('protein')->unsigned()->comment('タンパク質 g');
            $table->float('fat')->unsigned()->comment('脂質 g');
            $table->float('carbohydrate')->unsigned()->comment('炭水化物 g');
            $table->string('detail')->nullable()->comment('詳細');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};

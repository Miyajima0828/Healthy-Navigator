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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('calorie')->unsigned()->comment('カロリー kcal');
            $table->float('protein')->unsigned()->comment('タンパク質  g');
            $table->float('fat')->unsigned()->comment('脂質 g');
            $table->float('carbohydrate')->unsigned()->comment('炭水化物 g');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};

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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_type')->unsigned()->comment(
                'カテゴリータイプ 0:穀類 1:いも・でんぷん 2:砂糖・甘味類 3:豆類 4:種実類 5:野菜類 6:果実類 7:きのこ類 8:海藻類 9:魚介類 10:肉類 11:卵類 12:乳類 13:油脂類 14:菓子類 15:嗜好飲料類 16:調味料 17:調理済流通食品類'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

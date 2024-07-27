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
        Schema::create('users_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('merch_id');
            $table->integer('bought_flag')->default(0)->comment('-1=キャンセル、0=カゴの中にある、1=購入済み');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_stocks');
    }
};

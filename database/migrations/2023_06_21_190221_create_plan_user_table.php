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
        Schema::create('plan_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId("plan_id")->constrained("plans")->references("id")->cascadeOnDelete();
            $table->foreignId("user_id")->constrained("users")->references("id")->cascadeOnDelete();
            $table->integer("price");
            $table->dateTime("bought_at");
            $table->dateTime("expire_at");
            $table->boolean("active");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_user');
    }
};

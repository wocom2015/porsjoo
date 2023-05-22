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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->on("id");
            $table->foreignId("product_id")->constrained("products")->on("id");
            $table->integer("shares_count")->default(0);
            $table->integer("share_amount")->default(0);
            $table->integer("period")->default(0)->comment('on the basis of days');
            $table->integer("percent")->default(0)->comment('Profit percentage prediction');
            $table->integer("state")->default(0)->comment("investment state");
            $table->timestamps();
            $table->dateTime("finishes_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

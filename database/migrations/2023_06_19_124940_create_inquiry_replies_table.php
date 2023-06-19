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
        Schema::create('inquiry_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("inquiry_id")->constrained("inquiries")->references("id");
            $table->foreignId("user_id")->constrained("user_id")->references("id");
            $table->bigInteger("price");
            $table->string("description")->nullable();
            $table->integer("score")->nullable();
            $table->integer("state_id")->nullable();
            $table->boolean("accepted")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_replies');
    }
};

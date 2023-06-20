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
        Schema::create('inquiry_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("inquiry_id")->constrained("inquiries")->references("id");
            $table->foreignId("user_id")->constrained("users")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_suppliers');
    }
};

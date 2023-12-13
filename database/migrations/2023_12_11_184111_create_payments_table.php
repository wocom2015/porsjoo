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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->references("id");
            $table->foreignId("plan_id")->constrained("plans")->references("id");
            $table->string("clientrefid")->nullable();
            $table->string("refid" , 100)->nullable();
            $table->bigInteger("amount")->nullable();
            $table->integer("code")->nullable();
            $table->string("cardnumber")->nullable();
            $table->string("cardhashpan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

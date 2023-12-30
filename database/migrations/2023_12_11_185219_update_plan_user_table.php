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
        Schema::table("plan_user" , function (Blueprint $table){
            $table->foreignId("payment_id")->constrained("payments")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("plan_user" , function (Blueprint $table){
            $table->dropColumn("payment_id" );
        });
    }
};

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
        Schema::table("inquiry_replies" , function (Blueprint $table){
            $table->boolean("cheque_enable")->nullable();
            $table->boolean("sample_enable")->nullable();
            $table->boolean("guarantee_enable")->nullable();
            $table->boolean("visit_place_enable")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("inquiry_replies" , function (Blueprint $table){
            $table->dropColumn("cheque_enable");
            $table->dropColumn("sample_enable");
            $table->dropColumn("guarantee_enable");
            $table->dropColumn("visit_place_enable");
        });
    }
};

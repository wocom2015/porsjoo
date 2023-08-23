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
        Schema::table("inquiries" , function (Blueprint $table){
           $table->integer("cheque_count")->nullable();
           $table->integer("cash_percent")->nullable();
           $table->dateTime("close_date")->nullable();
           $table->string("move_conditions")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("inquiries" , function (Blueprint $table){
            $table->dropColumn("cheque_count");
            $table->dropColumn("cash_percent");
            $table->dropColumn("close_date");
            $table->dropColumn("move_conditions");
        });
    }
};

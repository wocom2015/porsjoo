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
        Schema::table("inquiries" , function(Blueprint $table){
            $table->boolean("accepted")->default(false);
            $table->dateTime("accepted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("inquiries", function (Blueprint $table) {
            $table->dropColumn("accepted");
            $table->dropColumn("accepted_at");
        });
    }
};

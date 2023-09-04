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
            $table->string("vendor_introduce_name" , 200)->nullable();
            $table->string("vendor_introduce_mobile" , 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("inquiries" , function (Blueprint $table){
            $table->dropColumn("vendor_introduce_name");
            $table->dropColumn("vendor_introduce_mobile");
        });
    }
};

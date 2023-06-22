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
        Schema::table("users" , function (Blueprint $table){
            $table->string("job_name" , 200);
            $table->string("phone" , 20)->nullable();
            $table->string("address" , 300)->nullable();
            $table->string("pm" , 200)->comment("purchase_management -- مسئول خرید")->nullable();
            $table->string("pm_mobile" , 20)->comment("purchase_management_mobile -- موبایل مسئول خرید")->nullable();
            $table->string("boss_mobile" , 20)->comment(" موبایل مدیرعامل")->nullable();
            $table->foreignId("category_id")->constrained("category")->on("id");
            $table->string("description" , 1000)->comment("توضیح مختصری از کسب و کار")->nullable();
            $table->string("logo" , 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users" , function (Blueprint $table) {
            $table->dropColumn("job_name");
            $table->dropColumn("phone");
            $table->dropColumn("address");
            $table->dropColumn("pm");
            $table->dropColumn("pm_mobile");
            $table->dropColumn("boss_mobile");
            $table->dropColumn("category_id");
            $table->dropColumn("description");
            $table->dropColumn("logo");
        });
    }
};

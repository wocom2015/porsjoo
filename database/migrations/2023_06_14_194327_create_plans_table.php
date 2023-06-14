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
            $table->string("name" , 100);
            $table->integer("length")->comment("مدت زمان اشتراک به ماه");
            $table->integer("pj_per_month")->comment("تعداد استعلام در هر ماه");
            $table->integer("price")->comment("قیمت طرح");
            $table->integer("suppliers_count")->comment("تعداد تامین کننده در هر بار استعلام");
            $table->boolean("active")->default(0)->comment("فعال بودن طرح");
            $table->timestamps();
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

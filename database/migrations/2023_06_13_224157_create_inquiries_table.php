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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->references("id")->on("users");
            $table->string("name" , 100);
            $table->foreignId("category_id")->references("id")->on("categories");
            $table->integer("count");
            $table->foreignId("unit_id")->references("id")->on("units");
            $table->string("description" , 2000)->nullable();
            $table->dateTime("buy_date")->nullable();
            $table->dateTime("pay_date")->nullable();
            $table->foreignId("province_id")->nullable()->references("id")->on("provinces");
            $table->foreignId("city_id")->nullable()->references("id")->on("cities");
            $table->bigInteger("price")->nullable();
            $table->boolean("cheque_enable")->nullable();
            $table->boolean("sample_enable")->nullable();
            $table->boolean("guarantee_enable")->nullable();
            $table->boolean("multiple_supplier")->nullable();
            $table->string("picture_path" , 100)->nullable();
            $table->string("picture" , 100)->nullable();
            $table->string("ext" , 5)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};

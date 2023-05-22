<?php

declare(strict_types=1);

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('description',400)->nullable();
            $table->string('picture',20)->nullable();
            $table->string('ext',5)->nullable();
            $table->integer('parent_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}

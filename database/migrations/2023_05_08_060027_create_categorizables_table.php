<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categorizables', function (Blueprint $table) {
            // Columns
//            $table->integer('category_id')->unsigned();
            $table->morphs('categorizable');
            $table->timestamps();

            // Indexes
            $table->unique(['category_id', 'categorizable_id', 'categorizable_type'], 'categorizables_ids_type_unique');
            /*            $table->foreign('category_id')->references('id')->on("categories")
                              ->onDelete('cascade')->onUpdate('cascade');*/
            $table->foreignId('category_id')->constrained("categories")->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('categorizables');
    }
}

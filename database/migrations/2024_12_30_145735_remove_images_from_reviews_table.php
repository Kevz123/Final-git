<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveImagesFromReviewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'image_1')) {
                $table->dropColumn('image_1');
            }
            if (Schema::hasColumn('reviews', 'image_2')) {
                $table->dropColumn('image_2');
            }
        });
    }
    
}

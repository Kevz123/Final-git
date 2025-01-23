<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('create_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('club_name');
            $table->enum('status', ['upcoming', 'completed']);
            $table->text('description');
            $table->date('date');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('create_news');
    }
}

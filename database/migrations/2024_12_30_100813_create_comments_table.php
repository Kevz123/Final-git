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
    if (!Schema::hasTable('comments')) {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->text('comment_text');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();

            // Add foreign key for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

};

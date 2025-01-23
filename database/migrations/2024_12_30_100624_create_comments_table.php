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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->text('comment_text');
            
            // Foreign key for the user who posted the comment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Foreign key for memberships or clubs, depending on your app logic
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->foreign('membership_id')->references('membership_id')->on('memberships')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

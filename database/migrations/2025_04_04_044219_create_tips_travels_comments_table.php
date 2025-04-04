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
        Schema::create('tips_travels_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tips_travel_id');
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tips_travel_id')
                ->references('id')
                ->on('tips_travels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips_travels_comments');
    }
};

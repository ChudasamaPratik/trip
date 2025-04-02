<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tips_travel', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('place_name');
            $table->string('image');
            $table->text('description1');
            $table->string('image1');
            $table->text('description2');
            $table->string('image2');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips_travel');
    }
};

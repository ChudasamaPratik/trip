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
        Schema::create('user_requirements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('origin');
            $table->string('destination');
            $table->integer('days');
            $table->integer('person');
            $table->string('accommodation');
            $table->string('image');
            $table->string('breakfast');
            $table->double('price', 10, 2);
            $table->string('tour');
            $table->enum('status', ['pending', 'public', 'assigned', 'quoted', 'confirmed'])->default('pending');
            $table->dateTime('response_deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requirements');
    }
};

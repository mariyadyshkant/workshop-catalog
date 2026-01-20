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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->integer('duration_hours');
            $table->text('requirements');
            $table->text('status');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('language', 50);
            $table->string('delivery_mode', 20);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('level_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

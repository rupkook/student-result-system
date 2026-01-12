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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('course_id')->nullable(); // Remove foreign key constraint
            $table->string('exam_type');
            $table->decimal('marks', 5, 2);
            $table->decimal('total_marks', 5, 2);
            $table->string('grade');
            $table->decimal('gpa', 3, 2);
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->date('exam_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};

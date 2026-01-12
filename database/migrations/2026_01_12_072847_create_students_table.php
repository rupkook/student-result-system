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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('address');
            $table->enum('department', ['mernstack', 'Web app development (full-stack)', 'UIUX', 'Python Programing', 'Graphic Design', 'Motion Design', 'Vedio Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking']);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

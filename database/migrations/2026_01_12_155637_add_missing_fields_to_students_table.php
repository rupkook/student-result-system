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
        Schema::table('students', function (Blueprint $table) {
            // Add missing fields
            $table->string('city')->nullable();
            $table->string('division')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->date('admission_date')->nullable();
            
            // Change department to course
            $table->dropColumn('department');
            $table->enum('course', ['MERN Stack', 'Web App Dev', 'UI/UX', 'Python', 'Graphic Design', 'Motion Design', 'Video Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['city', 'division', 'zip_code', 'country', 'admission_date', 'course']);
            // Restore department column
            $table->enum('department', ['mernstack', 'Web app development (full-stack)', 'UIUX', 'Python Programing', 'Graphic Design', 'Motion Design', 'Vedio Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'])->nullable();
        });
    }
};

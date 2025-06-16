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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable(); // Optional field for description
            $table->string('file_path');
            $table->string('original_fileName');
            $table->string('status')->default('submitted'); // 'submitted', 'cancelled', 'graded'
            $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Assuming submissions are linked to users
            $table->integer('grade')->default(0); // Optional field for grade
            $table->text('comment')->nullable(); // Optional field for comments
            $table->timestamp('graded_at')->nullable(); // Optional field for when the submission was graded
            $table->timestamps();
            $table->softDeletes(); // Tambahkan baris ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};

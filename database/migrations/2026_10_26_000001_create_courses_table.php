<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // FOREIGN KEY -> users.id
            $table->string('code', 20);
            $table->string('name', 120);
            $table->string('lecturer', 120)->nullable();
            $table->unsignedTinyInteger('credits')->default(3);
            $table->unsignedTinyInteger('day');   // hari kuliah: 1 = Senin ... 7 = Minggu
            $table->time('start_time');           // jam mulai
            $table->time('end_time');             // jam selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

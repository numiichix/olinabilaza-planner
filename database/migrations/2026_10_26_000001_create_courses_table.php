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
            $table->unsignedTinyInteger('day');   // class day: 1 = Monday ... 7 = Sunday
            $table->time('start_time');           // start time
            $table->time('end_time');             // end time
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

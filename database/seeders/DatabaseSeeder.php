<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun guest: guest@gmail.com / pass12345
        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => 'pass12345', // otomatis di-hash oleh model User
        ]);

        // day: 1 = Senin, 2 = Selasa, 3 = Rabu, ...
        $matdis = $user->courses()->create([
            'code' => 'EF234305', 'name' => 'Matematika Diskrit', 'lecturer' => 'Pak Ilham',
            'credits' => 3, 'day' => 1, 'start_time' => '07:00', 'end_time' => '09:30',
        ]);
        $pweb = $user->courses()->create([
            'code' => 'EF234301', 'name' => 'Pemrograman Web', 'lecturer' => 'Pak Irfan',
            'credits' => 3, 'day' => 2, 'start_time' => '09:40', 'end_time' => '12:10',
        ]);
        $jarkom = $user->courses()->create([
            'code' => 'EF234303', 'name' => 'Jaringan Komputer', 'lecturer' => 'Pak Bagus',
            'credits' => 3, 'day' => 2, 'start_time' => '12:30', 'end_time' => '15:00',
        ]);

        // Tugas awal akun guest
        $user->tasks()->create([
            'course_id' => $pweb->id, 'title' => 'Mengerjakan ETS pweb',
            'description' => 'Minimal 8 fitur, ada foreign key, deploy ke hosting gratis.',
            'deadline' => now()->addDays(3), 'priority' => 'high',
        ]);
        $user->tasks()->create([
            'course_id' => $matdis->id, 'title' => 'Mengerjakan latihan soal di buku',
            'deadline' => now()->addDays(5), 'priority' => 'medium',
        ]);
        $user->tasks()->create([
            'course_id' => $jarkom->id, 'title' => 'Mengerjakan handson',
            'deadline' => now()->addDays(7), 'priority' => 'medium',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Guest account: guest@gmail.com / pass12345
        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => 'pass12345', // automatically hashed by the User model
        ]);

        // day: 1 = Monday, 2 = Tuesday, 3 = Wednesday, ...
        $matdis = $user->courses()->create([
            'code' => 'EF234305', 'name' => 'Discrete Mathematics', 'lecturer' => 'Mr. Ilham',
            'credits' => 3, 'day' => 1, 'start_time' => '07:00', 'end_time' => '09:30',
        ]);
        $pweb = $user->courses()->create([
            'code' => 'EF234301', 'name' => 'Web Programming', 'lecturer' => 'Mr. Irfan',
            'credits' => 3, 'day' => 2, 'start_time' => '09:40', 'end_time' => '12:10',
        ]);
        $jarkom = $user->courses()->create([
            'code' => 'EF234303', 'name' => 'Computer Networks', 'lecturer' => 'Mr. Bagus',
            'credits' => 3, 'day' => 2, 'start_time' => '12:30', 'end_time' => '15:00',
        ]);

        // Initial tasks for the guest account
        $user->tasks()->create([
            'course_id' => $pweb->id, 'title' => 'Work on the Web Programming midterm project',
            'description' => 'At least 8 features, has a foreign key, deployed to free hosting.',
            'deadline' => now()->addDays(3), 'priority' => 'high',
        ]);
        $user->tasks()->create([
            'course_id' => $matdis->id, 'title' => 'Do the practice problems in the book',
            'deadline' => now()->addDays(5), 'priority' => 'medium',
        ]);
        $user->tasks()->create([
            'course_id' => $jarkom->id, 'title' => 'Do the hands-on lab',
            'deadline' => now()->addDays(7), 'priority' => 'medium',
        ]);
    }
}

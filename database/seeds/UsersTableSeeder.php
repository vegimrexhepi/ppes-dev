<?php

use Illuminate\Database\Seeder;
use ppes\Models\Role;
use ppes\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get role ids from database
        $lecturerId = Role::where('name', 'lecturer')->value('id');
        $studentId  = Role::where('name', 'student')->value('id');

        // initial lecturer user
        $user1 = User::create([
            'first_name'     => 'Lecturer',
            'last_name'      => 'Demo',
            'email'          => 'demo@lecturer.edu',
            'password'       => bcrypt('qwerty'),
        ]);

        // attach user1 with a role
        $user1->roles()->attach($lecturerId);

        // second lecturer user
        $user2 = User::create([
            'first_name'     => 'Student',
            'last_name'      => 'Demo',
            'email'          => 'demo@student.edu',
            'student_id'     => 'SE15001',
            'password'       => bcrypt('qwerty'),
        ]);

        // attach user2 with a role
        $user2->roles()->attach($studentId);

    }
}

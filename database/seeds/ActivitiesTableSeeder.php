<?php

use Illuminate\Database\Seeder;
use ppes\Models\Activity;
use ppes\Models\Criterion;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria[1] = Criterion::create([
            'name'           => 'Body Language',
        ]);
        $criteria[2] = Criterion::create([
            'name'           => 'Slide Organization',
        ]);
        $criteria[3] = Criterion::create([
            'name'           => 'Time Keeping',
        ]);
        $criteria[4] = Criterion::create([
            'name'           => 'Answering Questions',
        ]);
        $criteria[5] = Criterion::create([
            'name'           => 'Topic Knowledge',
        ]);

//        $activity1 = Activity::create([
//            'title'           => 'First Activity',
//            'bonus1'         => '50',
//            'bonus2'         => '25',
//            'invitation_link' => route('student.activities.enroll'),
//            'enrollment_key'  => substr(uniqid(), -6) . substr(uniqid(), -2),
//            'access_code'     => substr(uniqid(), -4),
//        ]);
//
//        foreach($criteria as $criterion){
//            $activity1->criteria()->attach($criterion->id);
//        }

    }
}

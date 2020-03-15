<?php

namespace ppes\Http\Controllers;

use ppes\Events\StudentEvaluationExpired;
use ppes\Events\StudentEvaluationStarted;
use ppes\Models\User;
use ppes\Models\Result;
use ppes\Http\Requests;
use ppes\Models\Activity;
use ppes\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use Event;
use Auth;

class LecturerActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  $lecturerId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $lecturerId)
    {

        // Get flash alert from the session (if exists)
        $flashAlert = $request->session()->get('flash_alert', null);

        //$activities = Activity::where('user_id', $lecturerId)->get();
        $activities = $request->user()->activities->sortByDesc('created_at');

        return view('lecturer.activities.index', [
            'flashAlert' => $flashAlert,
            'activities' => $activities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int  $lecturerId
     * @return \Illuminate\Http\Response
     */
    public function create($lecturerId)
    {
        $existingCriteria = Criterion::all();

        return view('lecturer.activities.create', ['existingCriteria' => $existingCriteria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int  $lecturerId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lecturerId)
    {
        // Validation rules
        $rules = [
            'title'     => 'required|min:3|max:255|unique:activities',
            'criteria'  => 'required',
            //'bonus1'    => 'min:0|max:100',
            //'bonus2'    => 'min:0|max:100'
        ];

        // Custom validation messages
        $messages = [
            'bonus1.min' => 'First bonus should be equal or greater than 0',
            'bonus2.min' => 'Second bonus should be equal or greater than 0',
            'bonus1.max' => 'First bonus should be equal or smaller than 100',
            'bonus2.max' => 'Second bonus should be equal or smaller than 100'
        ];

        // Validate the data taken from the request
        $this->validate($request, $rules);

        // Data are valid, store in the database
        $activity = Activity::create([
            //'user_id'   => $lecturerId,
            'title'     => $request->input('title'),
            //'bonus1'    => str_replace(' %', '', $request->input('bonus1')),
            //'bonus2'    => str_replace(' %', '', $request->input('bonus2')),
            'invitation_link' => route('student.activities.enroll'),
            'enrollment_key' => substr(uniqid(), -6) . substr(uniqid(), -2),
            'access_code'    => substr(uniqid(), -4),
        ]);

        // Save the lecturer with the activity
        $activity->users()->attach($lecturerId);

        foreach ($request->input('criteria') as $criterionName) {

            /*// Check if this criterion already exists in the database
            $existingCriterion = Criterion::where('name', $criterionName)->first();

            if ($existingCriterion) {

                // Criterion exists, only connect it with the activity
                $activity->criteria()->attach($existingCriterion->id);

            } else {

                // Criterion doesn't exists, first insert it into
                // the database, then connect it with activity.
                $criterion = Criterion::create([
                    'name' => $criterionName
                ]);

                $activity->criteria()->attach($criterion->id);

            }*/

            $criterion = Criterion::firstOrCreate([
                'name' => $criterionName
            ]);
            $activity->criteria()->save($criterion);

        }

        // Define flash alert object
        $flashAlert = new \stdClass();
        $flashAlert->type    = 'success';
        $flashAlert->content = 'Activity created.';

        $request->session()->flash('flash_alert', $flashAlert);

        return redirect()->route('lecturer.activities.confirmation', [
            'lecturer'   => $lecturerId,
            'activities' => $activity->id,
        ]);
    }

    /**
     * Get activity creation, confirmation view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function confirmation(Request $request, $lecturerId, $activityId)
    {

        try {

            $activity = Activity::findOrFail($activityId);

            // Get flash alert from the session (if exists)
            $flashAlert = $request->session()->get('flash_alert', null);

            return view('lecturer.activities.confirmation', [
                'activity'   => $activity,
                'flashAlert' => $flashAlert,
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $lecturerId
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $lecturerId, $activityId)
    {
        try {

            $activity = Activity::findOrFail($activityId);
            $enrolledStudents = DB::select("
                select * from users as u
                  inner join activity_user as ausr on (u.id = ausr.user_id)
                  inner join activities as a on (a.id = ausr.activity_id)
                where
                  (u.id in
                    (select usr.id from users as usr
                      inner join user_role as ur on (usr.id = ur.user_id)
                      inner join roles as r on (r.id = ur.role_id)
                    where (r.name = 'student'))
                  ) and
                  (a.id = :activityId)
                group by u.id;", [
                'activityId' => $activityId
            ]);

            return view('lecturer.activities.show', [
                'lecturerId' => $lecturerId,
                'activity' => $activity,
                'enrolledStudents' => $enrolledStudents

            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $lecturerId
            ]);

        }
    }

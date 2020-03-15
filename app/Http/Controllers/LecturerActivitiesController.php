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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $lecturerId, $activityId)
    {
        try {

            $activity = Activity::findOrFail($activityId);
            $existingCriteria = Criterion::all();
            $activityCriteria = [];
            foreach($activity->criteria as $criterion){
                $activityCriteria[] = $criterion->id;
            }
            return view('lecturer.activities.edit', [
                'activity' => $activity,
                'existingCriteria' => $existingCriteria,
                'activityCriteria' => $activityCriteria

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lecturerId, $activityId)
    {

        $flashAlert = new \stdClass();
        try {
            $activity = Activity::find($activityId);

            $activity->title = $request->get('title');
            //return $request->input('criteria');

            $activity->criteria()->detach();
            foreach ($request->input('criteria') as $criterionName) {

                $criterion = Criterion::firstOrCreate([
                    'name' => $criterionName
                ]);

                $activity->criteria()->save($criterion);

            }

            $activity->save();

            $flashAlert->type    = 'success';
            $flashAlert->content = 'Activity edited successfully';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $lecturerId
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $lecturerId
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function destroy($lecturerId, $activityId)
    {
        //
    }

    /**
     * List completed activities
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @return \Illuminate\Http\Response
     */
    public function results(Request $request, $lecturerId)
    {
        // Get flash alert from the session (if exists)
        $flashAlert = $request->session()->get('flash_alert', null);

        $listedActivities = [];

        $activities = Activity::with('users')->whereHas('users', function ($query) use ( $lecturerId )
        {
            $query->where('user_id', $lecturerId);

        })->orderBy('created_at','desc')->get();

        foreach($activities as $activity){
            if($activity->status == 1){
                $listedActivities[] = $activity;
            }else{
                $result = Result::where('activity_id', $activity->id)->first();
                if($result){
                    $listedActivities[] = $activity;
                }
            }
        }

        return view('lecturer.activities.results', [
            'flashAlert' => $flashAlert,
            'activities' => $listedActivities
        ]);
    }

    /**
     * Show results for a single completed activity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function resultsShow(Request $request, $lecturerId, $activityId)
    {
        try {

            $resultActivity = Activity::findOrFail($activityId);
            //return $activity1;
            $students = User::with('activities')->whereHas('activities', function ($query) use ( $activityId )
            {
                $query->where('activities.id', $activityId);
            })->orderBy('updated_at', 'DESC')->get();
            $completedStudents = [];
            foreach($students as $student){
                foreach($student->activities as $activity){
                    if($activity->pivot->completed == 1 && $activity->pivot->activity_id == $activityId){
                        $studentResult = Result::where('activity_id', $activityId)->where('voting_user_id', '!=', $lecturerId)->where('student_evaluated_id', $student->id)->get();
                        $evaluatedByLecturer = 0;
                        if(count(Result::where('activity_id', $activityId)->where('voting_user_id', $lecturerId)->where('student_evaluated_id', $student->id)->get())){
                            $evaluatedByLecturer = 1;
                        }
                        $totalValues = 0;
                        foreach($studentResult as $result){
                            $totalValues += $result->vote_value;
                        }
                        $averageVote = $totalValues / count($studentResult);
                        $completedStudents[] = ['student' => $student, 'average' => $averageVote, 'evaluated_by_lecturer' => $evaluatedByLecturer];
                    }
                }
            }
            //return $completedStudents;
            $attention = 0;
            foreach($completedStudents as $student){
                if($student['evaluated_by_lecturer'] == 0){
                    $attention = 1;
                }
            }
            //return $completedStudents;

            return view('lecturer.activities.results_show', ['activity' => $resultActivity, 'students' => $completedStudents, 'attention' => $attention]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results', [
                'lecturer' => $lecturerId
            ]);

        }
    }

    /**
     * Show results for a student of a single completed activity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $activityId
     * @param  int  $studentId
     * @return \Illuminate\Http\Response
     */
    public function resultsStudentShow(Request $request, $lecturerId, $activityId, $studentId)
    {
        try {

            $activity = Activity::findOrFail($activityId);
            $presenter = User::findOrFail($studentId);
            $allResults = [];
            foreach($activity->criteria as $criterion){
                $studentResult = Result::where('activity_id', $activityId)->where('voting_user_id', '!=', $lecturerId)->where('criterion_id', $criterion->id)->where('student_evaluated_id', $presenter->id)->get();
                $lecturerResult = Result::where('activity_id', $activityId)->where('voting_user_id', $lecturerId)->where('criterion_id', $criterion->id)->where('student_evaluated_id', $presenter->id)->get();
                $allResults[$criterion->name] = ['student_result' => $studentResult,'lecturer_result' =>  $lecturerResult];
            }
            //return $allResults;
            $averageResults = [];
            foreach($allResults as $name => $result){
                $sumValues = 0;
                //return $result[0];
                foreach($result['student_result'] as $value){
                    $sumValues += $value->vote_value;
                }
                if(count($result['lecturer_result'])){
                    $sumValuesLecturer = 0;
                    foreach($result['lecturer_result'] as $value){
                        $sumValuesLecturer += $value->vote_value;
                    }
                    $averageResults[$name] = ['student_avg' => ($sumValues / count($result['student_result'])),'lecturer_avg' =>  $sumValuesLecturer / count($result['lecturer_result'])];
                }else{
                    $averageResults[$name] = ['student_avg' => ($sumValues / count($result['student_result'])),'lecturer_avg' =>  0];
                }
            }
            //return $averageResults;
            $totalStudentAverage = 0;
            $totalLecturerAverage = 0;
            foreach($averageResults as $result){
                $totalStudentAverage += $result['student_avg'];
                $totalLecturerAverage += $result['lecturer_avg'];
            }
            $overallStudentAverage = $totalStudentAverage / count($averageResults);
            $overallLecturerAverage = $totalLecturerAverage / count($averageResults);
            //$lecturerResults
            //$lecturerResult = $result = Result::where('activity_id', $activityId)->where('criterion_id', $criterion->id)->where('student_evaluated_id', $presenter->id)->get();

            $flashAlert = $request->session()->get('flash_alert', null);

            return view('lecturer.activities.results_student_show', [
                'lecturerId' => $lecturerId,
                'activity' => $activity,
                'student'  => $presenter,
                'results' => $averageResults,
                'overallStudent' => $overallStudentAverage,
                'overallLecturer' => $overallLecturerAverage,
                'flashAlert' => $flashAlert
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results', [
                'lecturer' => $lecturerId
            ]);

        }
    }

    /**
     * Show lecturer evaluation screen
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $studentId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function evaluateStudent(Request $request, $lecturerId, $activityId, $studentId)
    {
        try {

            $activity = Activity::find($activityId);
            $activityCriteria = $activity->criteria;

            $student = User::findOrFail($studentId);

            return view('lecturer.activities.evaluate_student', [
                'lecturerId' => $lecturerId,
                'activityId' => $activityId,
                'student'  => $student,
                'activity'  => $activity,
                'activityCriteria' => $activityCriteria
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results', [
                'lecturer' => $lecturerId
            ]);

        }
    }

    public function evaluateStudentStore(Request $request)
    {
        $flashAlert = new \stdClass();

        $votingUser = Auth::user()->id;
        /*echo Result::where('voting_student_id', $votingUser)->where('activity_id',$request->get('activity_id'))->first();
        exit();*/
        if(Result::where('voting_user_id', $votingUser)->where('activity_id',$request->get('activity_id'))->where('student_evaluated_id',$request->get('student_id'))->first()){
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'You have already voted for this student!';
            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.index');
        }else{
            // Get data from request
            foreach($request->get('vote') as $criterion_id => $vote_value){
                //echo 'activity id: '.$request->get('activity_id').' criterion_id: '.$id.' value: '.$value.'<br>';
                $result = new Result;
                $result->activity_id = $request->get('activity_id');
                $result->voting_user_id = $votingUser;
                $result->student_evaluated_id = $request->get('student_id');
                $result->criterion_id = $criterion_id;
                $result->vote_value = $vote_value;
                $result->save();
            }
            $flashAlert->type    = 'success';
            $flashAlert->content = 'You have successfully voted!';
            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results.student.show',['lecturer' => Auth::user()->id, 'activity' => $request->get('activity_id'), 'student' => $request->get('student_id')]);
        }

    }

    /**
     * Show lecturer evaluation screen
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $studentId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function evaluatingStudent(Request $request, $lecturerId, $activityId, $studentId)
    {
        try {

            $student = User::findOrFail($studentId);

            // Fire the event
            Event::fire(new StudentEvaluationStarted($student));

            // Inform students that try to join an activity after
            // the activity has already been started, by using
            // the session to save the state of activity.
            $request->session()->put('activity_started', 1);

            return view('lecturer.activities.evaluating_student', [
                'lecturerId' => $lecturerId,
                'activityId' => $activityId,
                'student'  => $student,
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results', [
                'lecturer' => $lecturerId
            ]);

        }
    }

    public function evaluatingStudentExpired($activity_id, $student_id)
    {
        // Fire the event
        Event::fire(new StudentEvaluationExpired());
        DB::table('activity_user')
            ->where('user_id', $student_id)
            ->where('activity_id', $activity_id)
            ->update(['completed' => 1]);
        return 1;
    }

    /**
     * Show lecturer evaluation screen
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lecturerId
     * @param  int  $studentId
     * @param  int  $activityId
     * @return \Illuminate\Http\Response
     */
    public function evaluatedStudent(Request $request, $lecturerId, $activityId, $studentId)
    {
        try {

            $student = User::findOrFail($studentId);

            return view('lecturer.activities.evaluated_student', [
                'lecturerId' => $lecturerId,
                'activityId' => $activityId,
                'student'  => $student,
            ]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Activity not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.results', [
                'lecturer' => $lecturerId
            ]);

        }
    }
}

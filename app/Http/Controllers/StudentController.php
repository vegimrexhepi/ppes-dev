<?php

namespace ppes\Http\Controllers;

use Illuminate\Support\Facades\Event;
use ppes\Events\StudentJoinedEvaluation;
use ppes\Models\Activity;
use ppes\Models\Role;
use ppes\Models\User;
use ppes\Models\Result;
use ppes\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ppes\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flashAlert = $request->session()->get('flash_alert', null);

        return view('student.index', [
            'user'       => $request->user(),
            'flashAlert' => $flashAlert
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {

            $student = User::findOrFail($id);

            return view('student.show', ['student' => $student]);

        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert = new \stdClass();
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Student not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);
            
            return redirect()->route('student.results');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $flashAlert = $request->session()->get('flash_alert', null);
        $user = User::findOrFail($id);
        return view('student.profile', [
            'user' => $user,
            'flashAlert' => $flashAlert
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->get('password')){
            $rules = [
                'first_name'     => 'required',
                'last_name'     => 'required',
                'student_id'     => 'required',
                'email'  => 'required|email',
                'password'  => 'required|min:6',
                'password_confirmation'  => 'required|same:password'
            ];
        }else{
            $rules = [
                'first_name'     => 'required',
                'last_name'     => 'required',
                'student_id'     => 'required',
                'email'  => 'required|email'
            ];
        }

        // Validate the data taken from the request
        $this->validate($request, $rules);

        $flashAlert = new \stdClass();
        try {
            $user = User::find($id);
            $password = $request->get('current_password');
            if(Hash::check($password, $user->password)){
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->email = $request->get('email');
                $user->student_id = $request->get('student_id');
                //return $request->input('criteria');

                $user->save();

                $flashAlert->type    = 'success';
                $flashAlert->content = 'Your profile was edited successfully';

                $request->session()->flash('flash_alert', $flashAlert);

                return redirect()->route('student.index', [
                    'student' => $id
                ]);
            }else{
                $flashAlert->type    = 'danger';
                $flashAlert->content = 'Enter the correct password';

                $request->session()->flash('flash_alert', $flashAlert);

                return back();
            }



        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'User not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('student.index', [
                'student' => $id
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the enrollment form.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function activitiesEnroll(Request $request)
    {
        // Get flash alert from the session (if exists)
        $flashAlert = $request->session()->get('flash_alert', null);

        return view('student.activities.enroll', [
            'flashAlert' => $flashAlert
        ]);
    }

    public function activitiesEnrollWithKey(Request $request, $enrollmentKey)
    {
        // Define flash alert object
        $flashAlert = new \stdClass();

        $authenticatedStudent = auth()->user();

        if (!is_null($enrollmentKey)) {

            $activity = Activity::where('enrollment_key', '=', $enrollmentKey)->first();

            if ($activity) {

                $studentActivities = $authenticatedStudent->activities()->get();
                foreach($studentActivities as $studentActivity){
                    if($studentActivity->id == $activity->id){
                        $flashAlert->type    = 'danger';
                        $flashAlert->content = 'You have already enrolled for this activity!';
                        $request->session()->flash('flash_alert', $flashAlert);

                        return redirect()->route('student.activities.enrolled');
                    }
                }

                $authenticatedStudent->activities()->save($activity);

                $flashAlert->type    = 'success';
                $flashAlert->content = 'You have been successfully enrolled into the activity.';
                $request->session()->flash('flash_alert', $flashAlert);

                return redirect()->route('student.activities.enrolled');
            }

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Enrollment key provided is not valid!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        } else {

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'No enrollment key provided!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        }
    }

    /**
     * Enroll into a activity, by given access key.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activitiesEnrollStore(Request $request)
    {
        // Define flash alert object
        $flashAlert = new \stdClass();

        $authenticatedStudent = $request->user();
        $enrollmentKey = $request->input('enrollment_key', null);

        if (!is_null($enrollmentKey)) {

            $activity = Activity::where('enrollment_key', '=', $enrollmentKey)->first();

            if ($activity) {
                $studentActivities = $authenticatedStudent->activities()->get();
                foreach($studentActivities as $studentActivity){
                    if($studentActivity->id == $activity->id){
                        $flashAlert->type    = 'danger';
                        $flashAlert->content = 'You have already enrolled for this activity!';
                        $request->session()->flash('flash_alert', $flashAlert);

                        return back();
                    }
                }
                $authenticatedStudent->activities()->save($activity);

                $flashAlert->type    = 'success';
                $flashAlert->content = 'You have been successfully enrolled into the activity.';
                $request->session()->flash('flash_alert', $flashAlert);

                return redirect()->route('student.activities.enrolled');
            }

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'Enrollment key provided is not valid!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        } else {

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'No enrollment key provided!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        }
    }

    /**
     * Already enrolled activities
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function activitiesEnrolled(Request $request)
    {
        $user_id = auth()->user()->id;
        // Get all activities (temporary)
        $activities = Activity::with('users')->whereHas('users', function ($query) use ( $user_id )
        {
            $query->where('users.id', $user_id);
        })->orderBy('created_at','desc')->get();

        // Get flash message from the session if it exists
        $flashAlert = $request->session()->get('flash_alert', null);

        return view('student.activities.enrolled', [
            'activities' => $activities,
            'flashAlert' => $flashAlert
        ]);
    }

    public function activitiesEnrolledSuccess()
    {
        return view('student.activities.enrolled_success');
    }

    /**
     * Show single activity
     *
     * @param  int $id Activity Id
     * @return \Illuminate\Http\Response
     */
    public function activitiesEnrolledShow($id)
    {
        $activity = null;

        try {

            $activity = Activity::findOrFail($id);

        } catch (ModelNotFoundException $e) {

            // Don't do nothing, just catch the exception
            // so the execution will properly continue.

        }

        return view('student.activities.enrolled_show', [
            'activity' => $activity
        ]);
    }

    public function activitiesJoin(Request $request) {
        // Define flash alert object
        $flashAlert = new \stdClass();

        $authenticatedStudent = $request->user();
        $accessCode = $request->input('access_code', null);

        if (!is_null($accessCode)) {

            $activity = Activity::where('access_code', '=', $accessCode)->first();

            if ($activity) {

                $flashAlert->type    = 'success';
                $flashAlert->content = 'You have successfully joined to vote.';
                //$request->session()->flash('flash_alert', $flashAlert);

                // Fire student has joined event
                //Event::fire(new StudentJoinedEvaluation());

                // Check if activity has already been started
                //$activityStatus = $request->session()->get('activity_started', 0);

                return view('student.activities.evaluating', [
                    'access_code' => $accessCode,
                    'activity' => $activity,
                    //'activityStatus' => $activityStatus,
                    'student' => $authenticatedStudent,
                    'flashAlert' => $flashAlert
                ]);
            }

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'The provided access code is not valid!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        } else {

            $flashAlert->type    = 'danger';
            $flashAlert->content = 'No access code provided!';
            $request->session()->flash('flash_alert', $flashAlert);

            return back();

        }

    }

    public function activitiesEvaluating()
    {

        return view('student.activities.evaluating');
    }

    /**
     * Save the results from the evaluation
     *
     * @param Request $request
     */
    public function activitiesEvaluatingStore(Request $request)
    {
        $flashAlert = new \stdClass();

        $votingUser = Auth::user()->id;
        /*echo Result::where('voting_student_id', $votingUser)->where('activity_id',$request->get('activity_id'))->first();
        exit();*/
        if($votingUser == $request->get('student_id')){
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'You cannot vote for yourself!';
            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('student.index');
        }
        if(Result::where('voting_user_id', $votingUser)->where('activity_id',$request->get('activity_id'))->where('student_evaluated_id',$request->get('student_id'))->first()){
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'You have already voted for this student!';
            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('student.index');
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
            $flashAlert->content = 'You have successfully voted! Please join again to vote another student';
            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('student.index');
        }

    }

    /**
     * Student's overall results
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function activitiesResults(Request $request)
    {
        $user_id = Auth::id();
        // Check if there is an alert in the request's flash
        $flashAlert = $request->session()->get('flash_alert', null);
        // Get all activities (temporary)
        $activities = Activity::with('users')->whereHas('users', function ($query) use ( $user_id )
        {
            $query->where('users.id', $user_id)->where('completed', 1);
        })->orderBy('created_at','desc')->get();

        return view('student.activities.results', [
            'flashAlert' => $flashAlert,
            'activities'  => $activities,
        ]);
    }

    /**
     * Show single activity
     * 
     * @param  int $id Activity Id
     * @return \Illuminate\Http\Response
     */
    public function activitiesResultsShow($activityId)
    {

        try {

            $activity = Activity::findOrFail($activityId);
            $studentId = Auth::id();
            $presenter = User::findOrFail($studentId);
            //return $activity->users;
            foreach($activity->users as $user){
                if($user->isLecturer()){
                    $lecturerId = $user->id;
                }
            }
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
                    if(count($result['student_result'])){
                        $averageResults[$name] = ['student_avg' => ($sumValues / count($result['student_result'])),'lecturer_avg' =>  0];
                    }else{
                        $averageResults[$name] = ['student_avg' => 0,'lecturer_avg' =>  0];
                    }
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

            // Calculate bonuses

            return view('student.activities.results_show', [
                'lecturerId' => $lecturerId,
                'activity' => $activity,
                'student'  => $presenter,
                'results' => $averageResults,
                'overallStudent' => $overallStudentAverage,
                'overallLecturer' => $overallLecturerAverage
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

    public function activitiesExpired(Request $request)
    {
        $flashAlert = new \stdClass();
        $flashAlert->type    = 'danger';
        $flashAlert->content = 'Time has expired! You cannot vote for this student anymore. Join to vote for another student.';
        $request->session()->flash('flash_alert', $flashAlert);

        return redirect()->route('student.index');
    }

}

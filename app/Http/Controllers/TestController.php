<?php

namespace ppes\Http\Controllers;

use Illuminate\Http\Request;

use Event;
use ppes\Events\StudentEvaluationExpired;
use ppes\Events\StudentEvaluationStarted;
use ppes\Models\Activity;
use ppes\Models\User;
use Storage;
use ppes\Models\Criterion;
use Symfony\Component\HttpFoundation\AcceptHeaderItem;

class TestController extends Controller
{
    public function index()
    {
        return view('testview');
    }

    public function fireStudentEvaluationEvent()
    {
        $student = User::find(2);

        Event::fire(new StudentEvaluationExpired($student));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity_info_id = ['activity_info_id' => 1];
        return view('questionnaire.make_questionnaire.questionnaire_configure.questionnaire_configure', $activity_info_id);
    }
}

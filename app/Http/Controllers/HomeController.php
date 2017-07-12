<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;

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
//        $questions = Answer::where('questionnaire_id', 3)->get();
//        $answers = $questions->where('choice_id', 707);
//        dd($answers);
//        $questionnaire_id = 3;
//        $datas = [
//            ['is_non' => 1, 'choice_id' => 704],
//            ['is_non' => 0, 'choice_id' => 706],
//        ];
//        $conditions = ['or'];
//        $report = new ReportRepository();
//        dd($report->selectAnswersTable($questionnaire_id, $datas, $conditions));
        return view('home');
    }
}

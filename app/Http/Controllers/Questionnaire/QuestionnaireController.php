<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Question;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionnaireController extends Controller
{

    /**
     * @var QuestionnaireRepository
     */
    protected $questionnaire;

    /**
     * QuestionnaireController constructor.
     * @param QuestionnaireRepository $questionnaire
     */
    public function __construct(QuestionnaireRepository $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questionnaires = $this->questionnaire->questionnaire_paginate(2);
        return view('questionnaire.index', compact('questionnaires'));

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
    public function store(StoreQuestionnaireRequest $request)
    {
        $data = [
          'title' => $request->get('title'),
        ];
        $id = $this->questionnaire->create($data)->id;

        return redirect()->route('questionnaire.question', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = $this->questionnaire->byId($id);
        $questionnaire->delete();
        return redirect('/questionnaire');
    }
}

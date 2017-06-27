<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Http\Requests\ToggleTemplateRequest;
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
        $questionnaires = $this->questionnaire->questionnaire_paginate(8);
        $templates = $this->questionnaire->getAllTemplate();
        return view('questionnaire.index',
            ['questionnaires' => $questionnaires, 'templates' => $templates]);

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
        $start_time = date("Y-m-d H:i:s", strtotime($request->start_time));
        $end_time = date("Y-m-d H:i:s", strtotime($request->end_time));
        $data = [
          'title' => $request->get('title'),
          'start_time' => $start_time,
          'end_time' => $end_time,
          'author' => $request->get('author'),
          'sub_title' => $request->get('sub_title'),
        ];
        $id = $this->questionnaire->create($data)->id;

        //复制所选模板问题与选项到新建问题
        $template_id = $request->get('template');
        if($template_id)
            $this->questionnaire->loadSelectTemplate($template_id, $id);

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

    //更改当前调查问卷的模板状态
    public function toggleTemplate(ToggleTemplateRequest $request)
    {
        $id = $request->get('questionnaire_id');
        $this->questionnaire->toggleTemplate($id);
        return response()->json(['code' => 200]);
    }
}

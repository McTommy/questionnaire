<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Http\Requests\ToggleTemplateRequest;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use QrCode;

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
     * @param  \Illuminate\Http\Request $request
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
            'en_name' => $request->get('en_name'),
            'comment' => $request->get('comment')
        ];
        $id = $this->questionnaire->create($data)->id;

        //复制所选模板问题与选项到新建问题
        $template_id = $request->get('template');
        if ($template_id)
            $this->questionnaire->loadSelectTemplate($template_id, $id);

        return redirect()->route('questionnaire.question', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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

    //ajax变更问卷结束时间
    public function ajaxUpdateEndTime(Request $request)
    {
        $end_time = date("Y-m-d H:i:s", strtotime($request->new_time));
        $id = $request->get('id');
        if ($this->questionnaire->updateEndTime($id, $end_time))
            return response()->json(['code' => 200, 'message' => $end_time]);
        else
            return response()->json(['code' => 500, 'message' => '更新失败']);
    }

    //ajax检测问卷英文名唯一性
    public function ajaxVerifyEnName(Request $request)
    {
        $en_name = $request->get('en_name');
        if ($this->questionnaire->verifyEnName($en_name))
            return response()->json(['code' => 500, 'message' => '该英文名已存在']);
        return response()->json(['code' => 200]);
    }

    //ajax更新问卷英文名
    public function ajaxUpdateEnName(Request $request)
    {
        $en_name = $request->get('en_name');
        $id = $request->get('id');
        if ($this->questionnaire->verifyEnName($en_name))
            return response()->json(['code' => 500, 'message' => '英文名已存在']);
        $this->questionnaire->updateEnName($id, $en_name);
        return response()->json(['code' => 200, 'message' => $en_name]);
    }

    //ajax验证问卷名
    public function ajaxVerifyTitle(Request $request)
    {
        $title = $request->get('title');
        if ($this->questionnaire->byTitle($title))
            return response()->json(['code' => 500, 'message' => '中文名已存在']);
        return response()->json(['code' => 200]);

    }

    //ajax获取二维码
    public function ajaxGetCQrcode(Request $request)
    {
        $id = $request->get('id');
        $qrcode = QrCode::size(200)->generate(url("/questionnaire/show/" . $id));
        return response()->json(['code' => 200, 'message' => $qrcode]);
    }

}

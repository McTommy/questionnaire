<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\StoreAnswersRequest;
use App\Http\Requests\VerifyPhoneNumberRequest;
use App\Questionnaire;
use App\Repositories\AnswerRepository;
use App\Http\Controllers\Controller;
use App\Repositories\BlankRepository;
use App\Repositories\QuestionnaireRepository;
use Auth;

class StoreAnswersController extends Controller
{

    protected $answer;
    protected $blank;
    protected $questionnaire;

    /**
     * StoreAnswersController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepository $answer, BlankRepository $blank, QuestionnaireRepository $questionnaire)
    {
//        $this->middleware('auth');
        $this->answer = $answer;
        $this->blank = $blank;
        $this->questionnaire = $questionnaire;
    }

    //存储调查问卷信息到answer以及blank表中
    public function store(StoreAnswersRequest $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $phone_info = $request->get("phone");
        if($phone_info) {
            $is_exist = $this->blank->verifyPhoneNumber($questionnaire_id,
                $phone_info['question_id'], $phone_info['content']);
            if($is_exist) return response()->json(['code' => 500, 'message' => '该用户已参与此次活动']);
        }
        //组织数据格式
        $datas = $request->get('datas');
        //存储到数据库
        $this->answer->store($datas, $questionnaire_id);
        //存储成功,问卷答题数加一
        $this->questionnaire->incrementAnswerNumber($questionnaire_id);
        return response()->json(['code' => 200, 'message' => '问卷提交成功']);
    }

    //确认所填手机号与其他用户不重复
    public function verifyPhoneNumber(VerifyPhoneNumberRequest $request)
    {
        $ques_id = $request->get('questionnaire_id');
        $que_id = $request->get('question_id');
        $phone = $request->get('phone_number');
        if($phone) {
            $is_exist = $this->blank->verifyPhoneNumber($ques_id, $que_id, $phone);
            if($is_exist) return response()->json(['code' => 500, 'message' => '您已参与']);
        }
        return response()->json(['code' => 200]);
    }
}

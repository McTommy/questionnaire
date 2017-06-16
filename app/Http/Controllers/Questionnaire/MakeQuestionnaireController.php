<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MakeQuestionnaireController extends Controller
{

    public function index(Request $request)
    {
        if($request->isMethod('post'))
        {

        }
        $activity_info_id = ['activity_info_id' => 1];
        return view('questionnaire.make_questionnaire.questionnaire_configure.questionnaire_configure', $activity_info_id);
    }

    public function save(Request $request)
    {
        $data = $request->only(['activity_info_id', 'cities', 'questions', 'answers', 'awards']);
        return response()->json(['status' => '123', 'data' => $data]);
    }

}

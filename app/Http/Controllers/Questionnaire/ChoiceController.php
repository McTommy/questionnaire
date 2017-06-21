<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\ChoiceRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoiceController extends Controller
{

    protected $choice;
    protected $question;

    /**
     * ChoiceController constructor.
     * @param $choice
     */
    public function __construct(ChoiceRepository $choice, QuestionRepository $question)
    {
        $this->choice = $choice;
        $this->question = $question;
    }

    //创建选项
    public function createChoice()
    {

    }

    //编辑选项
    public function editChoice()
    {

    }

    //配置选项
    public function configureChoice()
    {

    }

    //删除选项
    public function deleteChoice()
    {

    }
}

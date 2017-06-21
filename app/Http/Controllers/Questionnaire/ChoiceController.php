<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\ChoiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoiceController extends Controller
{

    protected $choice;

    /**
     * ChoiceController constructor.
     * @param $choice
     */
    public function __construct(ChoiceRepository $choice)
    {
        $this->choice = $choice;
    }

    //创建选项
    public function createChoice()
    {

    }

    public function updateChoice()
    {

    }

    public function deleteChoice()
    {

    }
}

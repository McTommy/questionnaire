<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-20
 * Time: 下午3:53
 */

namespace App\Repositories;


use App\Choice;
use App\Question;

class QuestionRepository
{

    public function getFirstQuestion($id)
    {
        $condition = [
            ['questionnaire_id', $id],
            ['parent_order', null]
        ];
        return Question::where($condition)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byQuestionnaireId($id, $cookie = null)
    {
        $condition = [
            ['questionnaire_id', $id],
            ['parent_order', null]
        ];
        //条件查询缓存数据
        if ($cookie) {
            return Question::with(['choices' => function ($query) use ($cookie) {
                $query->with(['cache_answer' => function ($query) use ($cookie) {
                    $query->where('cookie', $cookie);
                }])->orderBy('order');
            }])->with(['cache_answers' => function ($query) use ($cookie) {
                $query->where('cookie', $cookie);
            }])->with(['cache_blank' => function ($query) use ($cookie) {
                $query->where('cookie', $cookie);
            }])->where($condition)->orderBy('order')->get();
        }
        return Question::with(['choices' => function ($query) {
            $query->orderBy('order');
        }])->where($condition)->orderBy('order')->get();
    }


    /**
     * @param $id
     * @return bool
     */
    public function hasPhoneNumber($id)
    {
        $condition = [
            ['questionnaire_id', $id],
            ['is_phone_number', 1]
        ];
        $question = Question::where($condition)->first();
        if ($question) return true;
        return false;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllSubQuestion($id, $cookie = null)
    {
        $condition = [
            ['questionnaire_id', $id],
            ['parent_order', '<>', null]
        ];
        if ($cookie) {
            return Question::with(['choices' => function ($query) use ($cookie) {
                $query->with(['cache_answer' => function ($query) use ($cookie) {
                    $query->where('cookie', $cookie);
                }])->orderBy('order');
            }])->with(['cache_answers' => function ($query) use ($cookie) {
                $query->where('cookie', $cookie);
            }])->with(['cache_blank' => function ($query) use ($cookie) {
                $query->where('cookie', $cookie);
            }])->where($condition)->orderBy('order')->get();
        }
        return Question::with(['choices' => function ($query) {
            $query->orderBy('order');
        }])->where($condition)->orderBy('order')->get();
    }

    public function getSpecifiedSubQuestion($id, $parent_order)
    {
        $condition = [
            ['questionnaire_id', $id],
            ['parent_order', $parent_order]
        ];
        return Question::where($condition)->get();
    }


    /**
     * @param $question_order
     * @param $questionnaire_id
     * @param null $sub_order
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSubQuesByQuesOrder($question_order, $questionnaire_id, $sub_order = null)
    {
        $condition = [
            ['questionnaire_id', $questionnaire_id],
            ['parent_order', $question_order],
            ['parent_order', '<>', null]
        ];
        if ($sub_order) {
            $condition = array_merge($condition, [['order', $sub_order]]);
            return Question::with('choices')->where($condition)->first();
        }
        return Question::with('choices')->where($condition)->get();
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveSingleChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 1,
            'order' => $array['order'],
            'is_required' => $array['is_required']
        ];
        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMultiChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 2,
            'order' => $array['order'],
            'maximum_option' => isset($array['maximum_option']) ? $array['maximum_option'] : null,
            'is_required' => $array['is_required'],
        ];
        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveFillInBlank($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 3,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'is_respondent_info' => isset($array['is_respondent_info']) ? $array['is_respondent_info'] : null,
            'is_phone_number' => isset($array['is_phone_number']) ? $array['is_phone_number'] : null,
        ];

        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMatrixSingleChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 4,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'parent_order' => isset($array['parent_order']) ? $array['parent_order'] : null,
        ];

        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMatrixScale($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 5,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
        ];

        return Question::create($data);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveParaDescrip($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 6,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
        ];

        return Question::create($data);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMultiBlank($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 7,
            'order' => $array['order'],
            'is_required' => $array['is_required']
        ];

        return Question::create($data);
    }


    /**
     * @param $questionnaire_id
     * @param $order
     * @param $old_order
     */
    public function changeOrder($questionnaire_id, $order, $old_order = null, $id = null)
    {
        $condition = [
            ['questionnaire_id', $questionnaire_id],
        ];
        $questions = Question::where($condition)->get();
        foreach ($questions as $question) {
            if ($question->parent_order == null) {
                //若存在旧order
                if ($old_order) {
                    //新大于旧， 更改区间内的order
                    if ($order > $old_order && $old_order < $question->order && $question->order <= $order && $question->id != $id) {
                        $question->order--;
                        $question->save();
                    } elseif ($order < $old_order && $old_order > $question->order && $question->order >= $order && $question->id != $id) {
                        $question->order++;
                        $question->save();
                    }

                } elseif ($question->order >= $order) {
                    $question->order++;
                    $question->save();
                }
            } else {
                //如果矩阵题parent_order
                if ($old_order) {
                    if ($question->parent_order >= $order && $question->parent_order < $old_order) {
                        $question->parent_order++;
                        $question->save();
                    } elseif ($question->parent_order <= $order && $question->parent_order > $old_order) {
                        $question->parent_order--;
                        $question->save();
                    } elseif ($question->parent_order == $old_order) {
                        $question->parent_order = $order;
                        $question->save();
                    }
                } elseif ($question->parent_order >= $order) {
                    $question->parent_order++;
                    $question->save();
                }

            }
        }
    }

    /**
     * @param $questionnaire
     * @param $order
     * @param $name
     */
    public function saveEditQuestion($questionnaire, $old_order, $order, $name, $is_required)
    {
        $data = [
            ['questionnaire_id', $questionnaire],
            ['order', $old_order],
            ['parent_order', null]
        ];
        $question = Question::where($data)->first();
        $question->name = $name;
        $question->is_required = $is_required;
        $question->order = $order;
        $question->save();
        return $question->id;
    }

    /**
     * @param $questionnaire
     * @param $order
     */
    public function deleteQuestion($questionnaire, $order)
    {
        $condition1 = [
            ['questionnaire_id', $questionnaire],
            ['order', $order],
            ['parent_order', null]
        ];
        //删除关联的选项
        $question = Question::where($condition1)->first();
        Choice::where('question_id', $question->id)->delete();
        //删除子问题关联的选项
        $condition2 = [
            ['questionnaire_id', $questionnaire],
            ['parent_order', $order],
        ];
        $sub_questions = Question::where($condition2)->get();
        foreach ($sub_questions as $sub_question) {
            foreach ($sub_question->choices as $choice) {
                $choice->delete();
            }
            //删除子问题
            $sub_question->delete();
        }
        //删除该问题
        $question->delete();
        //order大于该问题的order减一
        $data = [
            ['questionnaire_id', $questionnaire],
            ['order', '>', $order],
        ];
        $questions = Question::where($data)->get();
        foreach ($questions as $question) {
            $question->order--;
            $question->save();
        }
        //parent_order 大于该问题的减一
        $data = [
            ['questionnaire_id', $questionnaire],
            ['parent_order', '>', $order],
        ];
        $questions = Question::where($data)->get();
        foreach ($questions as $question) {
            $question->parent_order--;
            $question->save();
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getSpecifiedQuestion($request)
    {
        $condition = [
            ['questionnaire_id', $request->get('questionnaire_id')],
            ['order', $request->get('question_order')],
            ['parent_order', null]
        ];
        return Question::where($condition)->first();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function saveSubMatrixQuestion($data)
    {
        return Question::create($data);
    }
}
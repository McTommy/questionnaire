<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-15
 * Time: 下午9:47
 */
if (! function_exists('question_type')) {
    /**
     * 将数字转换为问题的中文名
     *
     * @param  int  $num
     * @return string
     */
    function question_type($num)
    {
        switch ($num) {
            case 1:
                $type = "单选";
                break;
            case 2:
                $type = "多选";
                break;
            case 3:
                $type = "填空";
                break;
            case 4:
                $type = "矩阵单选题";
                break;
            case 5:
                $type = "矩阵量表题";
                break;
            case 6:
                $type = "段落说明";
                break;
            case 7:
                $type = "多项填空题";
                break;
            default:
                $type = "自定义题型";
        }
        return $type;
    }
}


@extends('layouts.questionnaire')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('static/contents_folder/questionnaire_configure/css/questionnaire_configure.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/contents_folder/questionnaire_configure/spinner/jqueryui/jquery-ui-1.10.4.custom.min.css') }}">
@stop

@section('content')
    <!--自己的内容开始-->
    <div class="content_mb_subject">

        <!--你可以在这里写你自己的内容了-->
        <div class="step1 clearfix" >
            <p class="step1_title">Step1 : 创建固定问题选项（城区）【必填】</p>
            <div class="btn btn-primary creat_city " data-toggle="modal">创建城区</div><span class="max_creatable">最多可创建30个</span>
            <ul class="city_content clearfix">
                <li><div>朝阳区11</div><span>&times;</span></li>
                <li><div>朝阳2区</div><span>&times;</span></li>
                <li><div>朝阳2区</div><span>&times;</span></li>
                <li><div>朝阳区</div><span>&times;</span></li>
                <li><div>朝阳3区</div><span>&times;</span></li>
                <li><div>朝阳4</div><span>&times;</span></li>
                <li><div>朝阳区4</div><span>&times;</span></li>
                <li><div>朝阳5区</div><span>&times;</span></li>
                <li><div>朝阳5区</div><span>&times;</span></li>
            </ul>
        </div>

        <!--创建城区部分-->
        <!--创建问题部分-->
        <div class="step2">
            <p class="step2_title">Step2 : 创建问题【必填】</p>
            <div class="creat_question_btn btn btn-primary">创建问题</div>
            <div class="question_content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Q<span>1</span></th>
                        <th><span>您是否对我们的邮寄服务满意</span> <span>【单选】</span></th>
                        <th>
                            <div class="btn-group">
                                <div class="btn btn-default btn_config_rank">配置选项</div>
                                <div class="btn btn-default btn_edit_question">编辑</div>
                                <div class="btn btn-default btn_delete_question">删除</div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> </td>
                        <td class="rank_span"><span>非常不满意</span><span>非常满意</span> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>问题1 </td>
                        <td class="rank_radio"><input type="radio">1<input type="radio">2<input type="radio">3<input type="radio">4</td>
                        <td>
                            <div class="btn btn-group">
                                <div class="btn btn-default btn_edit_answer">编辑</div>
                                <div class="btn btn-default btn_delete_answer">删除</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>问题1 </td>
                        <td class="rank_radio"><input type="radio">1<input type="radio">2<input type="radio">3<input type="radio">4</td>
                        <td>
                            <div class="btn btn-group">
                                <div class="btn btn-default btn_edit_answer">编辑</div>
                                <div class="btn btn-default btn_delete_answer">删除</div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Q<span>2</span></th>
                        <th><span>22222222222</span> <span>【单选】</span></th>
                        <th>
                            <div class="btn-group">
                                <div class="btn btn-default btn_creat_answer">创建答案</div>
                                <div class="btn btn-default btn_edit_question">编辑</div>
                                <div class="btn btn-default btn_delete_question">删除</div>
                            </div>
                        </th>
                    </tr>

                    </thead>
                    <tbody></tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Q<span>3</span></th>
                        <th><span>33333333333333</span> <span>【单选】</span></th>
                        <th>
                            <div class="btn-group">
                                <div class="btn btn-default btn_creat_answer">创建答案</div>
                                <div class="btn btn-default btn_edit_question">编辑</div>
                                <div class="btn btn-default btn_delete_question">删除</div>
                            </div>
                        </th>
                    </tr>

                    </thead>
                    <tbody></tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Q<span>4</span></th>
                        <th><span>4444444444444</span> <span>【单选】</span></th>
                        <th>
                            <div class="btn-group">
                                <div class="btn btn-default btn_creat_answer">创建答案</div>
                                <div class="btn btn-default btn_edit_question">编辑</div>
                                <div class="btn btn-default btn_delete_question">删除</div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td class="span_group"><span>选项1</span><span>选项1</span><span>选项1</span></td>
                        <td>
                            <div class="btn btn-default btn_edit_question">编辑</div>
                        </td>
                    </tr>
                    <tr>
                        <td>问题1</td>
                        <td class="radio_group"><input type="radio" name="问题1"><input type="radio" name="问题1"><input type="radio" name="问题1"></td>
                        <td><div class="btn btn-default btn_edit_question">编辑</div></td>
                    </tr>
                    <tr>
                        <td>问题2</td>
                        <td class="radio_group"><input type="radio" name="问题2"><input type="radio" name="问题2"><input type="radio" name="问题2"></td>
                        <td><div class="btn btn-default btn_edit_question">编辑</div></td>


                    </tr>
                    <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="step3 clearfix">
            <div class="step3_title">Step3 : 创建奖励（卡券）【选填】</div>
            <p class="price-tips">*用户填完问卷后可以给予适当的奖励</p>
            <div class="step3_left">
                <div class="three-one">
                    <div class="three-one-title">
                        Step3.1:创建文字
                    </div>
                    <div class="three-one-content">
                        <textarea class="form-control creat-txt" rows="7" maxlength="300"></textarea>
                        <div class="txt-num">
                            <span class="txt-limit">0</span>/300
                        </div>

                    </div>
                </div>
                <div class="three-two">
                    <div class="three-two-title">
                        Step3.2: 创建奖励（只能选取一张卡券）
                    </div>
                    <div class="three-two-content">
                        <button class="btn btn-primary choose-card">选取卡券</button>
                        <div class="card-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>类型</th>
                                    <th>名称</th>
                                    <th>库存</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>代金券</td>
                                    <td>XXXXXXXXXXXXXXXXXX</td>
                                    <td>9999</td>
                                    <td>
                                        <div class="btn btn-default btn-delete-card">删除</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="step3_right">
                <div class="phone">
                    <div class="phone-content">
                        <div class="phone-txt">1111111</div>
                        <div class="phone-card"></div>
                    </div>
                </div>
            </div>


        </div>
        <div class="finish-creat">
            <button class="btn btn-primary finish">保存</button>
        </div>
    </div>
    <!--自己的内容结束-->
@endsection

@include('questionnaire.make_questionnaire.questionnaire_configure.modal')

@section('footer')
    @parent
    <div class="activity_info_id" style="display: none">{{ $activity_info_id }}</div>
@endsection

@section('js')
    <script src="{{ URL::asset('static/contents_folder/questionnaire_configure/js/questionnaire_configure.js') }}"></script>
@stop
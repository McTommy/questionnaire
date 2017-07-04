<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!--360 浏览器在读取到这个标签后，立即切换对应的极速核-->
    <meta name="renderer" content="webkit">
    <!--优先使用 IE 最新版本和 Chrome-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!--百度禁止转码-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--缩放比例为1-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">

    <title>调查问卷</title>
    <!--全局css开始-->
    <link href="{{ URL::asset('mobile_static/plugin_folder/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('mobile_static/common_folder/stylesheets/common_base.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('mobile_static/common_folder/less/Mobile_index.less') }}" rel="stylesheet/less">
    <!--全局css结束-->
    @yield('css')
</head>
<body>
@section('header')

@show

@section('content')
    <div class="content">
        <div class="foreword">欢迎参与本次问卷调查</div>
        <div class="question"  data-type="3" data-id="1">
            <div class="question_title" >
                <span class="que_num">1. </span><span class="que_content">您的姓名：</span><span class="star">* </span><span class="type">(填空)</span>
            </div>
            <div class="error_tips"  tabindex="2">请填写此题</div>
            <div class="answer">
                <input type="text" class="fill_in">
            </div>
        </div>
        <div class="question"  data-type="3" data-id="2">
            <div class="question_title" >
                <span class="que_num">2. </span><span class="que_content">您的电话：</span><span class="star">* </span><span class="type">(填空)</span>
            </div>
            <div class="error_tips"  tabindex="2">请填写此题</div>
            <div class="answer">
                <input type="text" class="fill_in">
            </div>
        </div>
        <div class="question" data-type="3" data-id="3">
            <div class="question_title" >
                <span class="que_num">3. </span><span class="que_content">您的住址：</span><span class="star">* </span><span class="type">(填空)</span>
            </div>
            <div class="error_tips"  tabindex="2">请填写此题</div>
            <div class="answer">
                <input type="text" class="fill_in">
            </div>
        </div>
        <div class="question" data-type="1" data-id="4">
            <div class="question_title" >
                <span class="que_num">4. </span><span class="que_content">受访地点：</span><span class="star">* </span><span class="type">(单选)</span>
            </div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">
                <div class="options">
                    <div class="option">
                        <label><input type="radio" name="4"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="radio" name="4"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="radio" name="4"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="radio" name="4"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="question" data-type="6" data-id="5">
            <div class="question_title">
                <strong>
                    <span class="que_num">5. </span><span class="que_content">一、甄别信息</span>
                </strong>
            </div>
        </div>
        <div class="question" data-type="2" data-id="6">
            <div class="question_title" >
                <span class="que_num">6. </span><span class="que_content">您今天在哪些场所进行了消费：</span><span class="star">* </span><span class="type">(多选)</span>
            </div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">
                <div class="options">
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="question" data-type="1" data-id="7">
            <div class="question_title" >
                <span class="que_num">7. </span><span class="que_content">受访地点：</span><span class="star">* </span><span class="type">(单选)</span>
            </div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">
                <div class="options">
                    <div class="option" data-jump="9">
                        <label><input type="radio" name="7"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option"data-jump="11">
                        <label><input type="radio" name="7"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option"data-jump="8">
                        <label><input type="radio" name="7"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option" data-jump="10">
                        <label><input type="radio" name="7"><span class="radio_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="radio" name="7" class="other_click"><span class="radio_new"></span>
                            <div class="option_content">其他<input type="text" class="other"></div>

                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="question" data-type="2" data-id="8" data-max="2">
            <div class="question_title" >
                <span class="que_num">8. </span><span class="que_content">您平时最常光顾的购物中心是哪两家：</span><span class="star">* </span><span class="type">(多选)</span>
                <span class="max_choose">(最多选<span>2</span>项)</span>
            </div>
            <div class="limit_tips" tabindex="2">最多选2项</div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">
                <div class="options">
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场是何沙何沙何沙何沙何沙何沙何沙何沙何沙何沙何沙何沙何沙</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广将坎坎坷坷坎坎坷坷坎坎坷坷坎坎坷坷坎坎坷坷坎坎坷坷场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4"><span class="check_new"></span>
                            <div class="option_content"> 通州万达广场</div></label>
                    </div>
                    <div class="option">
                        <label><input type="checkbox" name="4" class="other_click"><span class="check_new"></span>
                            <div class="option_content">其他<input type="text" class="other"></div>

                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="question" data-type="5" data-id="9">
            <div class="question_title" >
                <span class="que_num">9. </span><span class="que_content">以下是一些关于价值观和生活方式等方面等描述，请您根据自己的认可程度选择？</span><span class="star">* </span><span class="type">(打分题，请点选)</span>
            </div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">

                <table class="rank">
                    <thead>
                    <tr>
                        <td></td>
                        <td><span class="fl">非常不认可</span><span class="fr">非常认可</span></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>我喜欢运用信用卡分期付款等手段</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="rank1"><span class="radio_new"></span>1</label>
                                <label><input type="radio" name="rank1"><span class="radio_new"></span>2</label>
                                <label><input type="radio" name="rank1"><span class="radio_new"></span>3</label>
                                <label><input type="radio" name="rank1"><span class="radio_new"></span>4</label>
                                <label><input type="radio" name="rank1"><span class="radio_new"></span>5</label>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>量入检出才是正确等消费观念</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="rank2"><span class="radio_new"></span>1</label>
                                <label><input type="radio" name="rank2"><span class="radio_new"></span>2</label>
                                <label><input type="radio" name="rank2"><span class="radio_new"></span>3</label>
                                <label><input type="radio" name="rank2"><span class="radio_new"></span>4</label>
                                <label><input type="radio" name="rank2"><span class="radio_new"></span>5</label>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>我喜欢新鲜事物，乐于尝试新鲜事物和产品</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="rank3"><span class="radio_new"></span>1</label>
                                <label><input type="radio" name="rank3"><span class="radio_new"></span>2</label>
                                <label><input type="radio" name="rank3"><span class="radio_new"></span>3</label>
                                <label><input type="radio" name="rank3"><span class="radio_new"></span>4</label>
                                <label><input type="radio" name="rank3"><span class="radio_new"></span>5</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>一旦找到我喜欢的品牌，会坚持使用</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="rank4"><span class="radio_new"></span>1</label>
                                <label><input type="radio" name="rank4"><span class="radio_new"></span>2</label>
                                <label><input type="radio" name="rank4"><span class="radio_new"></span>3</label>
                                <label><input type="radio" name="rank4"><span class="radio_new"></span>4</label>
                                <label><input type="radio" name="rank4"><span class="radio_new"></span>5</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>我追求最新的时尚和潮流趋势</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="rank5"><span class="radio_new"></span>1</label>
                                <label><input type="radio" name="rank5"><span class="radio_new"></span>2</label>
                                <label><input type="radio" name="rank5"><span class="radio_new"></span>3</label>
                                <label><input type="radio" name="rank5"><span class="radio_new"></span>4</label>
                                <label><input type="radio" name="rank5"><span class="radio_new"></span>5</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="question" data-type="4" data-id="10">
            <div class="question_title" >
                <span class="que_num">10. </span><span class="que_content">您在亲子消费经常购买的单品价格？（¥元）</span><span class="star">* </span><span class="type">(单选)</span>
            </div>
            <div class="error_tips" tabindex="2">请填写此题</div>
            <div class="answer">
                <table class="array_single">
                    <thead>
                    <tr>
                        <td></td>
                        <td>儿童购物（服装／玩具／母婴用品）</td>
                        <td>亲子娱乐（单次）</td>
                        <td>儿童教育（单次）</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>50元以内</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>50～99元</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single2"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single2"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single2"><span class="radio_new"></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>100～199元</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single3"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single3"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single3"><span class="radio_new"></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>200～399元</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single4"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single4"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single4"><span class="radio_new"></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>400～599元</td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single5"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single5"><span class="radio_new"></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="rank_item">
                                <label><input type="radio" name="single5"><span class="radio_new"></span></label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="question" data-type="7" data-id="11">
            <div class="question_title" >
                <span class="que_num">11. </span><span class="que_content">请您写出自己的爱好？</span><span class="star">* </span><span class="type">(填空)</span>
            </div>
            <div class="error_tips">请填写此题</div>
            <div class="answer">
                <div class="options">
                    <div class="option">
                        <label><span class="fill_option">1.</span><input type="text"  class="mul_fill_input" ></label>
                    </div>
                    <div class="option">
                        <label><span class="fill_option">2.</span><input type="text" class="mul_fill_input"></label>
                    </div>
                    <div class="option">
                        <label><span class="fill_option">3.</span><input type="text" class="mul_fill_input"></label>
                    </div>
                    <div class="option">
                        <label><span class="fill_option">您近期最喜欢的两个爱好相关的作品／活动:</span><input type="text" class="mul_fill_input"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@show

@section('footer')
@show
</body>
<!--全局js开始-->
<script src="{{ URL::asset('mobile_static/plugin_folder/jquery_v1.11.3/jquery-1.11.3.min.js') }}"></script>
<script src="{{ URL::asset('mobile_static/plugin_folder/less_v1.7.0/less.min.js') }}"></script>
<script src="{{ URL::asset('mobile_static/common_folder/javascripts/base.js') }}"></script>
<script src="{{ URL::asset('mobile_static/common_folder/javascripts/common_index.js') }}"></script>
<!--全局js结束-->
@yield('js')
</html>
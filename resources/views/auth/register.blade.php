@extends('layouts.app')

@section('css')
    <link href="{{ URL::asset('static/contents_folder/login/less/login.less') }}" rel="stylesheet/less"/>
@stop

@section('content')
    <body class="login">
    <div class="wrp">
        <!--左侧背景图片开始-->
        <div class="login_left_part"></div>
        <!--左侧背景图片结束-->

        <!--右侧主体内容开始-->
        <div class="login_right_part">
            <div class="right_part_box">
                <div class="right_part_title">MEEZAO</div>
                <form action="{{ route('login') }}" method="POST" class="login_form">
                    {{ csrf_field() }}
                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="input-group-addon login_right_user">E-Mail:</label>
                        <input id="email" type="email" class="form-control login_username" name="email"
                               value="{{ old('email') }}" required
                               autofocus placeholder="请输入邮箱地址" aria-describedby="sizing-addon2">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="input-group-addon login_right_password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required
                               placeholder="请输入密码" aria-describedby="sizing-addon2">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-info" value="登录">
                    <p class="tips_box"></p>
                </form>
                <div class="right_part_bottom">WWW.MEEZAO.COM</div>
            </div>
        </div>
        <!--右侧主体内容结束-->
    </div>
    </body>
@endsection



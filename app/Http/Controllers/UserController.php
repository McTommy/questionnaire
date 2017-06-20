<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //密码重置页面
    public function resetPasswordShow()
    {
        return view('auth.passwords.reset');
    }

    //密码重置
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect('/');
    }
}

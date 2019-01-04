<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2019/1/3
 * Time: 下午8:51
 */

namespace App\Http\Controllers\Home;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class User extends Front
{
    /**
     * 验证用户是否实名认证
     * @param Request $request
     */
    public function hasRealize(Request $request)
    {
        $data = ['resultCode' => 1];

        return parent::_jsonMsg(200, 'success', $data);
    }

    /**
     * 退出登陆
     * @param Request $request
     */
    public function logout(Request $request)
    {
        session()->flush();

        return view('home.user.toLogin');
    }

    /**
     * 注册页面
     * @param Request $request
     */
    public function toRegister(Request $request)
    {
//        $cookie = Cookie::make('captcha', 1);

        return view('home.user.toRegister');
    }

    /**
     * 注册接口
     * @param Request $request
     */
    public function registerUser(Request $request)
    {
        dd(1);
    }

    /**
     * 忘记密码页面
     * @param Request $request
     */
    public function toForgotMM(Request $request)
    {

        return view('home.user.toForgotMM');
    }


    /**
     * 发送验证码
     * @param Request $request
     */
    public function getCode(Request $request)
    {

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2019/1/3
 * Time: 下午8:51
 */

namespace App\Http\Controllers\Home;



use App\Models\Authcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function getCheckCode(Request $request)
    {
        $mobile = $request->input('mobile');
        $type = $request->input('type', 1);
        if (!$mobile) return parent::_jsonMsg(4001, '手机号不能为空');

        try{
            DB::beginTransaction();
            $num = rand(1000, 9999);
            $code = parent::Sms($mobile, $num);

            Authcode::create([
                'phone' => $mobile,
                'code' => $code,
                'status' => 0,
                'type' => $type,
                'over_time' => date('Y-m-d H:i:s', time()+900),
            ]);


            DB::commit();

            return response_json(200, 'success');
        }catch (\Exception $e){
            DB::rollBack();
            Log::debug('发送验证码', ['info' => $e->getMessage()]);
            return response_json(500, '服务器错误');
        }


    }
}
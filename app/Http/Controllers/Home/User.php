<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2019/1/3
 * Time: 下午8:51
 */

namespace App\Http\Controllers\Home;



use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
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
        if (!$mobile) return response_json(4001, '手机号不能为空');

//        try{
            DB::beginTransaction();
            $num = rand(1000, 9999);
//            $code = parent::Sms($mobile, $num);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        // 必填，设置短信接收号码
        $request->setPhoneNumbers("12345678901");

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName("短信签名");

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode("SMS_0000001");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=>"12345",
            "product"=>"dsd"
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        $request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        $request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        return $acsResponse;


            dd($code);

            Authcode::create([
                'phone' => $mobile,
                'code' => $code,
                'status' => 0,
                'type' => $type,
                'over_time' => date('Y-m-d H:i:s', time()+900),
            ]);


            DB::commit();

            return response_json(200, 'success');
//        }catch (\Exception $e){
//            DB::rollBack();
//            Log::debug('发送验证码', ['info' => $e->getMessage()]);
//            return response_json(500, '服务器错误');
//        }


    }
}
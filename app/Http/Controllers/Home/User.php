<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2019/1/3
 * Time: 下午8:51
 */

namespace App\Http\Controllers\Home;



use Illuminate\Http\Request;

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
}
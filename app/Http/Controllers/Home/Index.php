<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Index extends Front
{

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('home.index.index');
    }

    /**
     * 采购需求发布
     * @param Request $request
     */
    public function toPub(Request $request)
    {
        return view('home.index.toPub');
    }

    /**
     * 查看需求详情
     * @param Request $request
     */
    public function toDetailDemand(Request $request)
    {
        return '查看需求详情';
    }
}

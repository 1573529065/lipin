<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Index extends Controller
{

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('home.index');
    }

    /**
     * 信息说明
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(){

        return view('home.info');
    }
}

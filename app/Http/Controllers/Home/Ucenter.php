<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Ucenter extends Controller
{

    /**
     * 发布采购首页
     */
    public function toCenter()
    {
        return view('home.Ucenter.toCenter');
    }
}

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Vcom extends Controller
{

    /**
     * 拜访采购首页
     */
    public function toVcoms()
    {
        return view('home.vcom.toVcoms');
    }
}

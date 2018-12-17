<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2018/12/12
 * Time: 下午10:47
 */

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;

class Supplier extends Front
{

    /**
     * @param Request $request
     */
    public function toSupplierMgr(Request $request)
    {
        return view('home.supplier.toSupplierMgr');
    }

    public function toSupplierDetail(Request $request)
    {
        return view('home.supplier.toSupplierDetail');

    }

}
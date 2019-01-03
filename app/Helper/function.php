<?php
/**
 * Created by PhpStorm.
 * User: zhw
 * Date: 2019/1/3
 * Time: 下午8:58
 */

/**
 *
 * 返回数据封装
 *
 * @param int $code
 * @param string $message
 * @param mixed $data
 * @param bool $other
 * @return Illuminate\Http\JsonResponse
 * @author jreey and @ifehrim
 */
if (!function_exists("response_json1")) {
    function response_json($first = 200, $message = "success", $data = null, $arr = [])
    {
        $param = func_get_args();
        /**
         * @author ifehrim @date 2018-2-27
         * first value is string run the condition
         * just not insert $first like this response_json($message,$data,$arr);
         */
        if (is_string($first)) {
            $message = $first;
            $first = 200;
            if (isset($param[1])) {
                $data = $param[1];
                $arr = [];
            }
            if (isset($param[2])) {
                $arr = $param[2];
            }
        }
        /**
         * @author ifehrim @date 2018-2-27
         * first value is array run the condition
         * just not insert $first and $message like this response_json($data,$arr);
         */

        if (is_array($first) || is_object($first)) {
            $data = $first;
            $message = "success";
            $first = 200;
            $arr = [];
            if (isset($param[1])) {
                $arr = $param[1];
            }
        }

        /**
         * because $first is not 200 ; so its not success;
         */
        if ($message == "success" && $first != 200) {
            $message = "failed";
        }


        $array = array(
            'status_code' => $first,
            'status' => $message == "success" ? "操作成功" : ($message == "failed" ? "操作失败" : $message),
        );
        if (!empty($data) && !is_null($data)) {
            $array['data'] = $data;
        }
        if (is_array($arr)) {
            $array = array_merge($array, $arr);
        }
        return response()->json($array);
    }

}
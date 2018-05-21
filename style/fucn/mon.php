<?php

/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/15
 * Time: 15:33
 **/
/*
 * @param $str 要处理的字符串
 * @param $length 截取多少
 * @param string $charset 编码
 * @param string $suffix 尾巴
 * @return string
 */
function lanjie($str,$length,$suffix="",$charset="utf-8"){
    $str = preg_replace("/<(.*?)>/","",$str);//    过滤html代码
    if(function_exists("mb_substr")){
        return mb_substr($str, '0', $length, $charset).$suffix;
    }
    elseif(function_exists('iconv_substr')){
        return iconv_substr($str,'0',$length,$charset).$suffix;
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], '0', $length));
    return $slice.$suffix;

}
/*
 *判断是否ajax请求
 */
function is_ajax(){
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        return true;
    }else{
        return false;
    }
}


/**
 * @return 判断是否是get请求
 */
function is_get(){
    return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
}

/**
 * 是否是POST提交
 * @return int
 */
function is_post() {
    return ($_SERVER['REQUEST_METHOD'] == 'POST' && checkurlHash($GLOBALS['verify']) && (empty($_SERVER['HTTP_REFERER']) || preg_replace("~https?:\/\/([^\:\/]+).*~i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("~([^\:]+).*~", "\\1", $_SERVER['HTTP_HOST']))) ? true :false;
}
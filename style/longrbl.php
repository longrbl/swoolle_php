<?php

namespace style;

/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/12
 * Time: 22:48
 */
use style\lib;

class longrbl
{
  private static $cla;

  /**
   * 系统初始化
   */
  static public function run($http,$response)
  {
    header("Content-type: text/html; charset=utf-8");
    include_once 'fucn/mon.php';//加载公共类
    try{
      lib\request::$http=$http;
      lib\request::$end=$response;
      lib\request::run();
    }catch (\Exception $e){
      echo '系统错误'.$e->getMessage();
    }

  }

  /**
   * @param $class
   * @return 自动加载类
   */
  static public function louad($class)
  {
    $class = str_replace('\\', '/', $class);
    $path = APP . '/' . $class . '.php';
    if (self::$cla[$class]) {
      return self::$class[$class];
    } else {
      include_once $path;
      self::$cla[$class] = $class;
    }
  }


}
<?php

namespace style\lib;

/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/12
 * Time: 23:17
 * 请求类 包括get post 获取url片段
 */
class request
{
  /**
   * 路由控制器 通过路由调指定控制器和方法
   * 地址必须是伪静态后的格式http://www.***.com/index/index
   */
  static public $http = '';
  static public $end = '';

  static public function run()
  {
    $url = self::$http->server['path_info'];
    $url = trim($url, '/');
    $url_array = explode('/', $url);
    if ($url_array['0'] == ADMIN_PATH) {
      if ($url != '/' && isset($url_array['1'])) {
        $ctlr = $url_array['1'];
        $action = $url_array['2'] ? $url_array['2'] : 'index';
      } elseif (!empty($url_array['1']) && empty($url_array['2'])) {
        $ctlr = $url_array['1'];
        $action = 'index';
      } else {
        $ctlr = 'index';
        $action = 'index';
      }
      $class_apth = PATH . '/ctlr/' . $url_array['0'] . '/' . $ctlr . '.php';
      if (is_file($class_apth)) {
        include_once $class_apth;
        $class = '\app\ctlr\\' . $url_array['0'] . '\\' . $ctlr;
        $ctlr_class = new $class;
        $action_l = $action . 'Ctlr';
        $ctlr_class->reqsrt = self::$http;
        $ctlr_class->end = self::$end;
        $ctlr_class->$action_l();
      } else {
        self::$end->end('非法访问后台');
      }
    } else {
      if ($url != '/' && isset($url_array['1'])) {
        $ctlr = $url_array['0'];
        $action = $url_array['1'];
      } elseif (!empty($url_array['0']) && empty($url_array['1'])) {
        $ctlr = $url_array['0'];
        $action = 'index';
      } else {
        $ctlr = 'index';
        $action = 'index';
      }
      $class_apth = PATH . '/ctlr/' . $ctlr . '.php';
      if (is_file($class_apth)) {
        include_once $class_apth;
        $class = '\app\ctlr\\' . $ctlr;
        $ctlr_class = new $class;
        $action_l = $action . 'Ctlr';
        $ctlr_class->reqsrt = self::$http;
        $ctlr_class->end = self::$end;
        $ctlr_class->$action_l();
      } else {
       self::$end->end('控制器不存在');
      }


    }

  }

  /**
   * @param $int 必须是数字
   * @return bool
   * 获取url地址的片段数据 没有数据就返回false
   */
  static function url($int, $leis = false)
  {
    if ($leis) {
      self::$end->end('获取url片段的偏移值必须是数字');
    }
    $url = self::$http->server['path_info'];
    $url = trim($url, '/');
    $url_array = explode('/', $url);
    if (isset($url_array[$int])) {
      if (strstr($url_array[$int], '?')) {
        $uid = explode('?', $url_array[$int]);
        return $uid['0'];
      } elseif (strstr($url_array[$int], '.')) {
        $uid = explode('.', $url_array[$int]);
        return $uid['0'];
      } else {
        return $url_array[$int];
      }
    } else {
      return false;
    }
  }

  /*
   *获取get数据
   * get的字段为空的话就返回false;
   * 不能包含中文和特殊字符
   */
  static function get($string = '')
  {
    if (empty($string)) {
      return $_GET;
    } else {
      //处理非法字符串不能包含中文和特殊字符！
      $biaos = "/^[A-Za-z0-9=-]+$/";
      if (empty($_GET[$string])) {
        return $_GET[$string];
      } else {
        if (!preg_match($biaos, $_GET[$string])) {
          self::$end->end('url地址不能包含非法字符串');
        } else {
          return $_GET[$string];
        }
      }

    }

  }

  /**
   * @param string $string
   * @return boo
   * 获取post数据
   * post的字段为空就返回false
   */
  static function post($string = '')
  {
    if (empty($string)) {
      return $_POST;
    } else {
      if (empty($_POST[$string])) {
        return false;
      } else {
        return $_POST[$string];
      }

    }

  }

}
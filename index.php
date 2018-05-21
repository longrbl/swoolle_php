<?php
header("Content-type: text/html; charset=utf-8");
define('APP', __DIR__);
define('PATH', APP . '/app');//应用目录
define('STYLE', 'style');//框架目录
define('ADMIN_PATH', 'admin');//后台框架目录名称
define('DUBG', false);//是否调试true开启调试false关闭调试
error_reporting(E_ALL & ~E_NOTICE);//屏蔽不严重的报错信息
if (DUBG) {
  ini_set('display_errors', 'On');
} else {
  ini_set('display_errors', 'Off');
}
include STYLE . '/longrbl.php';//框架主文件
spl_autoload_register('style\longrbl::louad');//自动new 未引入的类
/**
 * 本系统需要支持命名空间
 */




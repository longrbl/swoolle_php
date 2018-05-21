<?php
/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/13
 * Time: 1:10
 */
namespace app\confg;
use \PDO;
class db{

    static function get(){
        return array('database_type' => 'mysql',
            'database_name' =>'longrbl',
            'server' =>'127.0.0.1',
            'username' =>'root',
            'password' =>'478120174',
            'port' => 3306,
            'charset' => 'utf8',
            'option' => array(PDO::ATTR_CASE => PDO::CASE_NATURAL)
        );
    }


}
<?php
/**
数据库初始化类
 */

namespace style\lib;

class moder
{

    static  protected  $db;

    static  function get(){//性能考虑确保在一个方法里面只有一次初始化设置
//        if(self::$db){
//            $re = self::$db;
//            return $re;
//        }else{
            $re=self::$db=new medoo(\app\confg\db::get());
            return $re;
//        }
    }
}
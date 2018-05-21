<?php
namespace app\moder;
/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/15
 * Time: 15:40
 */
use style\lib\moder;
class news
{
    /**
     *获取所有新闻数据并且分页
     */
    static function  getall(){
        $sql = moder::get()->query("SELECT * FROM user ORDER BY rand()")->fetchAll();
        return $sql;
        }

    /**
     * 统计所有
     */
        static function conmt_s($id){
            $sql = moder::get()->count($id);
            return $sql;

        }

}
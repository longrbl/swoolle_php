<?php
namespace app\ctlr\admin;
use style\lib\Ctlr;
/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/15
 * Time: 12:38
 */
class index extends Ctlr
{
    public function __construct()
    {
        //可以再这里检查用户是否登陆
        //和一些初始化设置
    }
    public function indexCtlr(){
       $this->end->end(json_encode($_GET));
    }
}
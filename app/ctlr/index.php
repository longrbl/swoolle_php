<?php

namespace app\ctlr;

use app\moder\news;
use style\lib\ctlr;//引入控制器命名空间
use style\lib\page;
use style\lib\request;

//数据库操作语法就在http://medoo.lvtao.net/


class index
{

  public function __construct()
  {
    //可以再这里检查用户是否登陆
    //和一些初始化设置
  }

  public function indexCtlr()
  {


    $sql = news::getall();//从数据获取数据并且分页排列


      $this->end->end(json_encode($sql));






  }
}
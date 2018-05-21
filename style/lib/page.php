<?php
/**
 * Created by 豆豆.
 * User: longrbl@163.com
 * Date: 2016/9/15
 * Time: 13:53
 */

namespace style\lib;
//资料 https://github.com/1290800466/php_page/blob/master/index.php
// 分页类
class page
{
    private $myde_total;          //总记录数
    private $myde_size;           //一页显示的记录数
    private $myde_page;           //当前页
    private $myde_page_count;     //总页数
    private $myde_i;              //起头页数
    private $myde_en;             //结尾页数
    private $myde_url;            //获取当前的url
    /*
     * $show_pages
     * 页面显示的格式，显示链接的页数为2*$show_pages+1。
     * 如$show_pages=2那么页面上显示就是[首页] [上页] 1 2 3 4 5 [下页] [尾页]
     */
    private $show_pages;
   public function __construct($myde_total = 1, $myde_size = 1, $myde_page = 1, $myde_url, $show_pages = 2) {
        $this->myde_total = $this->numeric($myde_total);
        $this->myde_size = $this->numeric($myde_size);
        $this->myde_page = $this->numeric($myde_page);
        $this->myde_page_count = ceil($this->myde_total / $this->myde_size);
        $this->myde_url = $myde_url;
        if ($this->myde_total < 0)
            $this->myde_total = 0;
        if ($this->myde_page < 1)
            $this->myde_page = 1;
        if ($this->myde_page_count < 1)
            $this->myde_page_count = 1;
        if ($this->myde_page > $this->myde_page_count)
            $this->myde_page = $this->myde_page_count;
        $this->limit = ($this->myde_page - 1) * $this->myde_size;
        $this->myde_i = $this->myde_page - $show_pages;
        $this->myde_en = $this->myde_page + $show_pages;
        if ($this->myde_i < 1) {
            $this->myde_en = $this->myde_en + (1 - $this->myde_i);
            $this->myde_i = 1;
        }
        if ($this->myde_en > $this->myde_page_count) {
            $this->myde_i = $this->myde_i - ($this->myde_en - $this->myde_page_count);
            $this->myde_en = $this->myde_page_count;
        }
        if ($this->myde_i < 1)
            $this->myde_i = 1;
    }

    //检测是否为数字
    private function numeric($num) {
        if (strlen($num)) {
            if (!preg_match("/^[0-9]+$/", $num)) {
                $num = 1;
            } else {
                $num = substr($num, 0, 11);
            }
        } else {
            $num = 1;
        }
        return $num;
    }
    //地址替换
    private function page_replace($page) {
        $uri = $this->myde_url.'/'.$page;
        return $uri;
    }
    //首页
//    private function myde_home() {
//        if ($this->myde_page != 1) {
//            return "<li><a href='" . $this->page_replace(1) . "' title='首页'>&laquo;</a></li>";
//        } else {
//            return "<li class=\"disabled\"><a href=\"#\">&laquo;</a></li>";
//        }
//    }
    //上一页
    private function myde_prev() {
        if ($this->myde_page != 1) {
            return "<li><a href='" . $this->page_replace($this->myde_page - 1) . "' title='上一页'>&laquo;</a></li>";
        } else {
            return "<li class=\"disabled\"><a href='#'>&laquo;</a></li>";
        }
    }
    //下一页
    private function myde_next() {
        if ($this->myde_page != $this->myde_page_count) {
            return "<li><a href='" . $this->page_replace($this->myde_page + 1) . "' title='下一页'>&raquo;</a></li>";
        } else {
            return"<li class=\"disabled\"><a href='#'>&raquo;</a></li>";
        }
    }
    //尾页
//    private function myde_last() {
//        if ($this->myde_page != $this->myde_page_count) {
//            return "<li><a href='" . $this->page_replace($this->myde_page_count) . "' title='尾页'>&raquo;</a></li>";
//        } else {
//            return "<li class=\"disabled\"><a href=\"#\">&raquo;</a></li>";
//        }
//    }
    //输出
    public function myde_write() {
        $str = "<ul class=\"pagination\">";
        $str.=$this->myde_prev();
        for ($i = $this->myde_i; $i <= $this->myde_en; $i++) {
            if ($i == $this->myde_page) {
                $str.="<li><a href='" . $this->page_replace($i) . "' title='第" . $i . "页' class=\"active\">$i</a></li>";
            } else {
                $str.="<li><a href='" . $this->page_replace($i) . "' title='第" . $i . "页'>$i</a></li>";
            }
        }
        $str.=$this->myde_next();

//        $str.="<p class='pageRemark'>共<b>" . $this->myde_page_count .
//            "</b>页<b>" . $this->myde_total . "</b>条数据</p>";
        $str.="</ul>";
        return $str;
    }

}
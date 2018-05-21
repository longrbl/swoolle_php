<?php
/**
 *PHP生成配置文件类
 */
class confg_json{
    /**
     * 读取文件信息
     */
    static public $path ="/style_confg.json";//生成配置文件的路径
    /**
     * 生成新的配置文件
     * @return [type] [description]
     */
   static function set_name(){
        if(!is_file(self::path)){
            $text = fopen(self::path,'w');
            fwrite($text,'{"k_unnll_cc":"null"}');//第一次写数据进去防止报错
            fclose($text);
        }
    }
    /**
     *读取数据
     * @return [type] [description]
     */
    static function get(){
        $text = fopen(self::path,'r');
        return fread($text,filesize(self::path));
        fclose($text);
    }
    /**
     * 设置配置数据到文件
     * @param [type] $name [数组]
     */
    static function set($name){
        if(is_file(self::path)){
            $text = fopen(self::path,'r');
            $cong =  fread($text,filesize(self::path));//读取文件的数据
            $array =json_decode($cong,true);
            if(!empty($array)){
                foreach($array as $k=>$v){
                    $json[$k]=$v;
                    foreach($name as $j=>$t){
                        if($k==$j){
                            $json[$k]=$t;
                        }else{
                            $json[$j]=$t;
                        }
                    }
                }
            }else{
                foreach($name as $k=>$v){
                    $json[$k]=$v;
                }
            }
            unset($json['k_unnll_cc']);
            $myfile = fopen(self::path, "w") or die("Unable to open file!");
            $txt = json_encode($json);
            fwrite($myfile,$txt);
            fclose($myfile);
            fclose($text);
        }


    }

    /**
    删指定配置数据
    $anme 字符串
     */
   static function unsets($name){
        $text = fopen(self::path,'r');
        $cong =  fread($text,filesize(self::path));//读取文件的数据
        $array =json_decode($cong,true);
        foreach($array as $k=>$v){
            $json[$k]=$v;
            if($k==$name){
                unset($json[$name]);
            }
        }
        $myfile = fopen(self::path, "w") or die("Unable to open file!");
        $txt = json_encode($json);
        fwrite($myfile,$txt);
        fclose($myfile);
        fclose($text);
    }

}



?>
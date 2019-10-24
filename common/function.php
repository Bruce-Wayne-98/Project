<?php
//存放公共函数文件 全局函数库
// $id=$_GET['id'];//$id试卷编号//$_GET 全局数组 (关联数组)通过键取值
// echo $id;
//函数:一段具有特殊功能的代码段
//封装好处:实现代码的重复使用 代码的保密性（完整性）
function getTestId(){
    $id=isset($_GET['id'])?$_GET['id']:'1';
    $id=max($id,1);
    //越界
    if($id>count(glob('data/*.php'))){
        echo "id非法";
        return;
    }
    return $id;
}
//判断试卷是否存在 file_exists -检查文件目录是否存在
function getTestById($id,$kg=true){
    $filePath="data/$id.php";//文件路径
    if(!file_exists($filePath)){
        echo "文件不存在";
        return;
        //exit退出程序
    }
    $data=require "data/$id.php";
    //$data 数组
    //递归调用
    //匿名函数相当于表达式 一定要加分号;
    $fnc=function($data) use(&$fnc){
        //如何判断一个变量是否为数组 is_array
        $result=[];
        foreach($data as $k=>$v){
            //判断当前试题信息是否为数组 如果是 递归调用 继续扒数组
            //如果不是数组 判断是否为字符串 如果是 处理
            //如果不是
        $result[$k]=is_array($v)?$fnc($v):(is_string($v)?toHtml($v):$v);
        }
        return $result;
    };
    return $kg?$fnc($data):$data;
   
}
function toHtml($str){
    //ENT_QUOTE既转换双引号也转换单引号
    //对HTML中的特殊字符进行处理
    htmlspecialchars($str,ENT_QUOTES);
    //将空格转换为 实体字符 &nbsp
    //str_replace 字符串替换
    return str_replace(' ','&nbsp;',$str);

}

$count=[];//题目个数
$score=[];//每题的分数
function getTestInfo($txData){
    foreach($txData as $k=>$v){
            $count[$k]=count($v['data']);
            //总分/题目个数=每题的分数
            $score[$k]=round($v['score']/$count[$k],2);
    }
    //打包:数组
    return [$count,$score]; 
}
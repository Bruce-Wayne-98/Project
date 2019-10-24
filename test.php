<?php
//通过 require 加载外部公共函数库
require "common/function.php";
    // echo "KS";
//1获取试卷编号
$id=getTestId();
//2根据编号 加载试卷
$data=getTestById($id,$kg=true);
//3 获取试卷中题型的试题个数 每个试题分数 每个题的问题
//如何拆包 list
list($count,$score)=getTestInfo($data['data']);
//4 展示考试页面 加载静态资源文件
 require "view/test.html";

//替代语法
// foreach ($data['data']['binary']['data'] as $k=>$v) {
//     echo '<br>';
//     // echo $k, '*****';
//     // var_dump($v);
//     echo $v['question'];
// }
// var_dump($data['data']['binary']['data'][1]['question']);
//将静态页面中静态的东西 替换成变量 =》动态页面用PHP变量替换静态的东西
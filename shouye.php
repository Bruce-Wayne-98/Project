<?php

    // echo "恭喜项目创建成功";
    //1 修改加载CSS样式 文件路径
    //2 设计题库 1》数据库的概念：存放数据仓库 2》数据库本质：文件
        //php 运行在服务器的脚本语言
        //3》使用PHP文件存放题库
        //4》文件名应具有规律性 使用循环加载文件
        //5》将题库存放在服务器 (在服务器创建一个文件夹存放题库 1-100.php)
        //6》如何创建试卷内容 ？数组存放试卷内容(判断，单选，多选，填空)
        //7》数组中写什么？试卷拥有的公共特点(属性)
    //3 动态加载题库
    //获取试卷的信息（名称 考试时间 总分）
    // require 加载外部资源文件  include
    //关联数组
    // glob 返回的是该路径下 php结尾的文件数组
    // count计算数组中元素的个数
    
    $count=count(glob("data/*.php"));
    $info=[];//空数组 存放试卷的三个信息（题目 时间 分数）
    for($i=1;$i<=$count;$i++){
        $data=require "data/$i.php";

        $info[$i]=[
        'title'=>$data['title'],
        'time'=>$data['time']/60,
        'score'=>getscore($data['data'])
        ];
    
    }        
    // 销毁变量 释放给定的变量
    unset($data); 
    //$tolData 题型数组
    function getscore($tDa){
        //遍历题型数组 将每个题型的分数加在一起 得到总分
        // foreach(数组 as $KEY=>VALUE);
        $sum=0; //存放总分变量
        foreach($tDa as $k=>$v){
            // $sum=$sum+$v['score'];
            $sum+=$v['score'];
               }
               return $sum;//将最总结果返回到函数调用处
    }
    // print_r($info);
    // print_r($info);//$info是一个索引数组 其中数组元素嵌套一个关联数组
      // require "view/index.html";
    //4 将获取到的试卷信息(题目 时间 总分)显示首页
    require "view/index.html";
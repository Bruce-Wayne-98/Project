<?php
    require "common/function.php";
    // echo "Submit!";
    //1用户答案
    // $userAnswer=$_POST['binary'][1];
    //2标准答案 （存放试卷中）
        //2.1获取试卷编号
        $id=getTestId();
        //代码重用
        //2.2获取试卷编号 加载试卷
        $data=getTestById($id);
        //2.3获取每一题多少分
        list($count,$score)=getTestInfo($data['data']);
        //2.4从试卷中获取标准答案
        // $bzAnswer=$data['data']['binary']['data'][1]['answer'];
      
    //3 比较用户答案 和标准答案
    $sum=0;//保存用户得分
    $total=[];//定义一个全局的空数组 保存答题情况
    //题型的名字变为变量
    $tx=['binary','single','multible','fill'];
     //4计算用户得分
    foreach ($data['data'] as $type=>$tx) {
        foreach($tx['data'] as $k=>$v){//$k试题编号 $v试题数组(question answer)
        //用户答案
         $userAnswer=$_POST[$type][$k];
        //标准答案
        $bzAnswer=$v['answer'];
        if($userAnswer==$bzAnswer){
            $total[$type][$k]=true;
            $sum=$sum+$score[$type];
        }else{
            $total[$type][$k]=false;
        }
    }
}
// foreach($total as $type=>$tx){
//     foreach($v as $k=>$v){
//     // echo '<br>';
//     // echo $k.'////////////';
//     // var_dump($v);
//     }
// }
// var_dump ($total);
    //5展示得分页面
     require "view/total.html";
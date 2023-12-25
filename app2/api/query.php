<?php
include_once "db.php";
//處理查詢資料的請求
switch($_GET['do']){
    case "all":
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($Student->all());
    break;
    case 'sex':
        $users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where substr(`uni_id`,2,1)='{$_GET['value']}'");

        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($users);
    break;
    case 'class':
        // 連表查詢找出classstudent資料表的班級class_code等於點擊班級的value找出所有此班級，知道此班級有哪些學號
        // 知道此班級學號拿來與student資料表的school_num相等的話，透過student找才會撈到id的資料，此id存進nums
        // 再從student資料表where把存在in裡的id為條件，來撈出所有此班級的人
        $stnums=$ClassStudent->all(['class_code'=>$_GET['value']]);
        //dd($stnums);
        $nums=[];
        foreach($stnums as $st){
            $s=$Student->find(['school_num'=>$st['school_num']]);
            if(!empty($s)){
                $nums[]=$s['id'];
            }
        }
        $in=join(',',$nums);
        $users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where `id` in($in)");

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
            
    break;
    case 'classes':
        $classes=$Class->q("select `code`,`name` from `classes`");
        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($classes);
    break;
}

?>
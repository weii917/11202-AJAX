<?php
include_once "db.php";
//處理查詢資料的請求
switch($_GET['do']){
    case "all":
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($Student->all());
    break;
    case 'sex':
        dd($_GET);
    break;
    case 'class':
        
    break;
}

?>
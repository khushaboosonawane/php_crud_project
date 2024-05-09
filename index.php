<?php
include("database.php");
$obj=new Database();
$obj->insert("student",['student_name'=>"khushaboo",'student_mobile'=>'9665065113','student_email'=>"sokhushaboo202@gmail.com","student_pss"=>"123456"]);
print_r($obj->getResult());
?>
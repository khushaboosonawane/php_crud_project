<?php
include("database.php");
$obj=new Database();
// $obj->insert("student",['student_name'=>"khushaboo",'student_mobile'=>'9665065113','student_email'=>"sokhushaboo202@gmail.com","student_pss"=>"123456"]);
// print_r($obj->getResult());
$obj->update("student",['student_name'=>"khushaboo","student_mobile"=>"966545654","student_email"=>"sokhufhtfe@gmail.com","student_pss"=>"sdfgh"],"stu_id='2'");
print_r($obj->getResult());
?>
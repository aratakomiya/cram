<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


function get_as_array($link,$sql){
    if($result=mysqli_query($link,$sql)){
        $data=[];
        if (mysqli_num_rows($result) > 0) {
 
            // １件ずつ取り出す
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
 
        }
          mysqli_free_result($result);
    }
     return $data;
}



function get_request_method() {
   return $_SERVER['REQUEST_METHOD'];
}

function get_post_data($key) {
   $str = '';
   if (isset($_POST[$key]) === TRUE) {
       $str = $_POST[$key];
   }
   return $str;
}

function validate_number($str){
    if(preg_match("/^[0-9]+$/", $str)!==1){
        return FALSE;
    }
    return TRUE;
}

function get_db_connect(){
    if (!$link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME)){
         die('error: ' . mysqli_connect_error());
    }
    mysqli_set_charset($link, DB_CHARACTER_SET);
 
    return $link;
}

function close_db_connect($link){
    mysqli_close($link);
}

function isPost(){

    if($_SERVER['REQUEST_METHOD']==='POST'){
        return true;
    }
    return false;

}

function getGet($name,$default=null){

    if(isset($_GET[$name])){
        return $_GET[$name];
    }
    return $default;
}

function getPost($name,$default=null){

    if(isset($_POST[$name])){
        return $_POST[$name];
    }
    return $default;
}

function getHost(){
    if(!empty($_SERVER['HTTP_HOST'])){
        return $_SERVER['HTTP_HOST'];
    }
    return $_SERVER['SERVER_NAME'];
}

function isSsl(){
    if(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'){
        return true;
    }
    return false;
}

function getRequestUri(){
    return $_SERVER['REQUEST_URI'];
}

function my_es($link,$str){
    $str = mysqli_real_escape_string($link, $str);
    return $str;
}
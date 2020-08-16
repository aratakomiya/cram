<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}

// function insert_db($link,$sql){
//     if(mysqli_query($link,$sql)!==TRUE){
//         $err_msg[]='bbs_table:INSERT error'.$sql;
//         return FALSE;
//     }
    
//     return TRUE;
// }



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
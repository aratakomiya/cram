<?php

require_once '../include/const.php';
require_once '../include/function.php';
// リクエストメソッド確認
if (get_request_method() !== 'POST') {
   // POSTでなければログインページへリダイレクト
   header('Location: top_login.php');
   exit;
}
// セッション開始
session_start();
// POST値取得
$user_name  = get_post_data('user_name'); 
$password = get_post_data('password'); 
// ユーザー名をCookieへ保存
setcookie('user_name', $user_name, time() + 60 * 60 * 24 * 365);
// データベース接続
$link = get_db_connect();
// ユーザー名とパスワードからuser_idを取得するSQL
$sql = 'SELECT id FROM user
       WHERE user_name =\'' . $user_name . '\' AND password =\'' . $password . '\'';
       
// SQL実行し登録データを配列で取得
$data = get_as_array($link, $sql);
// データベース切断
close_db_connect($link);
// 登録データを取得できたか確認
if (isset($data[0]['id'])) {
   // セッション変数にuser_idを保存
   $_SESSION['id'] = $data[0]['id'];
   $_SESSION['user_name'] = $user_name;

  if($user_name!=='admin'){
    header('Location: ../tool/start.php');
    exit;
  }
} else {
   // セッション変数にログインのエラーフラグを保存
   $_SESSION['login_err_flag'] = TRUE;
   // ログインページへリダイレクト
   header('Location: top_login.php');
   exit;
}
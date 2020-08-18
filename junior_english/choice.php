<?php
// ログイン処理
session_start();
if (isset($_SESSION['id']) === TRUE) {
    

   $id = $_SESSION['id'];
   $user_name = $_SESSION['user_name'];
} else {
   // 非ログインの場合、ログインページへリダイレクト
   header('Location: ../../login/top_login.php');
   exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中学英単語 </title>
    <style>
     .button {
      display       : inline-block;
      border-radius : 15%;          /* 角丸       */
      font-size     : 15pt;        /* 文字サイズ */
      text-align    : center;      /* 文字位置   */
      cursor        : pointer;     /* カーソル   */
      padding       : 12px 12px;   /* 余白       */
      background    : #00007f;     /* 背景色     */
      color         : #ffffff;     /* 文字色     */
      line-height   : 1em;         /* 1行の高さ  */
      transition    : .3s;         /* なめらか変化 */
      box-shadow    : 5px 5px 43px #666666;  /* 影の設定 */
      border        : 2px solid #00007f;    /* 枠の指定 */
    }
    .button:hover {
      box-shadow    : none;        /* カーソル時の影消去 */
      color         : #00007f;     /* 背景色     */
      background    : #ffffff;     /* 文字色     */
    }
    .top{
      margin:0 40%;
    }
    .middle{
        margin:5px 40%;
    }
    .middle a{
        color:red;
    }
    </style>
</head>
<body>
　　<div class="top">
　　　<form action="../tool/start.php">
    <input type="submit" value="TOP">
    </form>
    <h1>中学英単語</h1>
      <ul>
      <li><form action="junior_en/junior_en_index.php" method="post"><input type="submit" value="英語→日本語" class="button"></form></li>
      <li><form action="junior_ja/junior_ja_index.php" method="post"><input type="submit" value="日本語→英語" class="button"></form></li>
      </ul>
    </div>
    <div class="middle">
    <a href="../img/junior_en.pdf" target="_blank">生徒配布用はこちら</a>
    </div>
</body>
</html>
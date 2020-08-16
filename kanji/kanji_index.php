<?php
// ログイン処理
session_start();
if (isset($_SESSION['id']) === TRUE) {
    

   $id = $_SESSION['id'];
   $user_name = $_SESSION['user_name'];
} else {
   // 非ログインの場合、ログインページへリダイレクト
   header('Location: ../login/top_login.php');
   exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>漢字テスト</title>
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
        margin:10px 40%;
        border:solid 3px red;
    }
    .middle p{
        font-size:20px;
    }
    </style>
</head>
<body>
　　<div class="top">
　　　<form action="../tool/start.php">
    <input type="submit" value="TOPページ">
    </form>
    <h1>漢字テスト</h1>
    
    <form method="POST" action="kanji_problem.php">
      <label for="start">始まりの数字:</label><input type="text" name="start" id="start"><br>
      <label for="end">終わりの数字:</label><input type="text" name="end" id="end"><br>
      <label for="length">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp出題数:</label><input type="text" name="length" id="length"><br>
      <input type="hidden" name="words">
      <input type="submit" name="create" value="作成" class="button">
    </form>
    </div>
    <div class="middle">
     <p>レベル</p>
     <ul>
     <li>1~400　　　漢字検定5級</li>
     <li>401~800　　漢字検定4級</li>
     <li>801~1200 　漢字検定3級</li>
     <li>1201~1584　漢字検定準2級</li>
     <li><a href="../img/生徒配布用.pdf" target="_blank">生徒配布用はこちら</a></li>
     </ul>
    </div>
</body>
</html>
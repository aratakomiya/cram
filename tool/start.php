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
    <title>wordtest</title>
　　 <style>
      h1{
          color:white;
      }
      img{
          width:300px;
          height:300px;
      }
      body{
        background-image:url(84081260.jpeg);
        background-repeat: no-repeat;
        background-size:cover;
      }
      .logout{
          color:white;
          font-size:15px;
      }
      .top{
         display:table;
      }
      .top a{
          color:white;
      }
    </style>
</head>
<body>
    <div class="top">
    <h1>単語テスト</h1>
    <a href="../login/logout.php" >ログアウトする</a>
    </div>
　　　<div class="pic">
       <a href="../kanji/kanji_index.php"><img src="../img/kanji.png" title="小中学漢字"></a>
       <a href="../junior_english/choice.php"><img src="../img/junior_en.png" title="中学英単語"></a>
       <a href="../target_5/target_5_index.php"><img src="../img/target_5.jpeg" title="ターゲット_5英単語"></a>
       <a href="../target_6/target_6_index.php"><img src="../img/target_6.jpeg" title="ターゲット_6英単語"></a>
       <a href="../system/system_index.php"><img src="../img/system.jpg" title="システム英単語"></a>
       <a href="../system_5/system_5_index.php"><img src="../img/system_5jpeg.jpeg" title="システム英単語＿5"></a>
       <a href="../sokutan/sokutan_index.php"><img src="../img/sokudoku.jpg" title="速読英単語"></a>
       <a href="../sokujuku/sokujuku_index.php"><img src="../img/sokujuku.jpeg" title="速読英熟語"></a>
       <a href="../senior/senior_index.php"><img src="../img/senior.jpg" title="速読英単語上級"></a>
       <a href="../duo/duo_index.php"><img src="../img/duo.jpeg" title="DUO"></a>
       <a href="../toushin/toushin_index.php"><img src="../img/toushin.jpeg" title="東進英単語"></a>
       <a href="../toushin_i/toushin_i_index.php"><img src="../img/toushin_i.jpeg" title="東進英熟語"></a>
       <a href="../kobun315/kobun315_index.php"><img src="../img/kobun315.jpeg" title="古文単語315"></a>
       <a href="../madonna/madonna_index.php"><img src="../img/madonna.jpg" title="マドンナ古文単語"></a>
       <a href="../tunagaru/tunagaru_index.php"><img src="../img/tunagaru.jpeg" title="つながる、まとまる古文単語500"></a>
       <a href="../pass_s2/pass_s2_index.php"><img src="../img/pass_s2.png" title="パス単準2級"></a>
     </div>
</body>
</html>
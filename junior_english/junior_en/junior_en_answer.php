<?php
require_once '../../include/function.php';
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

$words = unserialize(base64_decode($_POST["answer"]));
$start = unserialize(base64_decode($_POST["start"]));
$end = unserialize(base64_decode($_POST["end"]));
$length = unserialize(base64_decode($_POST["length"]));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中学英単語　英→日</title>
    <style>
     .border{
        border:solid 1px;
     }
      th{
        background-color: #53a7ef;
     }
     tr:nth-child(2n+1) {
        background-color: #edf9ff;
     }
     table{
         margin:0 auto;
         width:50%;
     } 
     .top{
         margin: 0 45%; 
     }
     
      @media print{
        .noprint {
          display: none;
        }
        .header {
          font-size:5px;
          text-align:center;
        }
        
        table {
          border-collapse: collapse;
          width:100%;
        }
        td,th {
          border: 2px #000000 solid;
          padding: 0px;
        }
        
      }
      
      
    </style>
</head>
<body>
  <section>
   <div class="top">
   　　<table>
        <tr>
        <td><form action="junior_en_index.php">
        <input type="submit" value="問題作成ページ">
        </form></td>
        <td><form action="junior_en_problem.php" method="post">
        <INPUT TYPE="hidden" NAME="answer" VALUE="<?= base64_encode(serialize($words)); ?>">
        <INPUT TYPE="hidden" NAME="start" VALUE="<?= base64_encode(serialize($start)); ?>">
        <INPUT TYPE="hidden" NAME="end" VALUE="<?= base64_encode(serialize($end)); ?>">
        <INPUT TYPE="hidden" NAME="length" VALUE="<?= base64_encode(serialize($length)); ?>">
        <INPUT TYPE="hidden" NAME="return" >

        <input type="submit" value="問題"  class="noprint">
       </form></td>
       <td><input type="button" value="印刷" class="noprint" onclick="window.print();"/></td>
       </tr>
       </table>
   </div>
　　　<table class="border">
        <caption><?php print '中学英単語　英→日　範囲　'.$start.'~'.$end.'まで　　出題数　'.$length ?></caption>
                    <tr class="border">
                        <th class="border">番号</th>
                        <th class="border">英単語</th>
                        <th class="border">日本語訳</th>
                    </tr>
                
        <?php       foreach ($words as $word) { ?>
                    <tr class="border">
                        
                        <td class="border"><?php print h($word['number']); ?></td>
                        <td class="border"><?php print h($word['word']); ?></td>
                        <td class="border"><?php print h($word['translation']); ?></td>
                        
                    </tr>
        <?php    } ?>
     </table>
     </section>
</body>
</html>
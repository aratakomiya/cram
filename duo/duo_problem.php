<?php
require_once '../include/function.php';

$host   = 'mysql1028.db.sakura.ne.jp'; 
$user   = 'cram-school';  
$passwd = 'cram-school';   
$dbname = 'cram-school_practice';
$err_msg = [];
$words = [];

// DB接続
$link=mysqli_connect($host,$user,$passwd,$dbname);
if($link === FALSE){
   print 'DB接続失敗';
   exit;
}

mysqli_set_charset($link,'utf8');

if (isset($_POST["words"])) {
    if (empty($_POST["start"])||empty($_POST["end"])) { 
        $err_msg[] = '始まりの数字もしくは終わりの数字がが未入力です。';
    } else if (empty($_POST["length"])) {
        $err_msg[] = '出題数が未入力です。';
    } 

    $start=0;
    if(isset($_POST['start'])){
            $start=$_POST['start'];
        }
    if (preg_match('/^[0-9]+$/', $start) === 0) {
            $err_msg[] = '半角数字で入力してください。';
        }

    $end=0;
    if(isset($_POST['end'])){
            $end=$_POST['end'];
        }
    if (preg_match('/^[0-9]+$/', $end) === 0) {
            $err_msg[] = '半角数字で入力してください。';
        }

    $length=0;
    if(isset($_POST['length'])){
            $length=(int)$_POST['length'];
        }
    if (preg_match('/^[0-9]+$/', $length) === 0) {
            $err_msg[] = '半角数字で入力してください。';
        }
        
    $view=$end-$start+1;
    $word_start=$start-1;
    $limit  = ' limit ' . $word_start . ',' . $view;
    $limit=my_es($link,$limit);
    if (count($err_msg)===0){
        if($link!==FALSE){
            $sql='SELECT * FROM duo order by number'.$limit;
            
            if ($result = mysqli_query($link, $sql)) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $words[$i]['number'] = htmlspecialchars($row['number'], ENT_QUOTES, 'UTF-8');
                    $words[$i]['word'] = htmlspecialchars($row['word'], ENT_QUOTES, 'UTF-8');
                    $words[$i]['translation'] = htmlspecialchars($row['translation'], ENT_QUOTES, 'UTF-8');
                    $i++;
                }
              } else {
                $err_msg[] = 'SQL失敗:' . $sql;
              }
              $words[]=shuffle($words);
              $words=array_slice($words,0,$length);
              mysqli_free_result($result);
        }
    }
}
if(isset($_POST['return'])===TRUE){
    $words = unserialize(base64_decode($_POST["answer"]));
    $start = unserialize(base64_decode($_POST["start"]));
    $end = unserialize(base64_decode($_POST["end"]));
    $length = unserialize(base64_decode($_POST["length"]));
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUO単語テスト</title>
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
<?php  foreach ($err_msg as $err){ ?>
        <li><?php print $err; ?></li>
 <?php } ?>
<section >
       <div class="top">
       <table>
        <tr>
        <td><form action="duo_index.php">
        <input type="submit" value="問題作成ページ">
        </form></td>
        <td><form action="duo_answer.php" method="post">
        <INPUT TYPE="hidden" NAME="answer" VALUE="<?= base64_encode(serialize($words)); ?>">
        <INPUT TYPE="hidden" NAME="start" VALUE="<?= base64_encode(serialize($start)); ?>">
        <INPUT TYPE="hidden" NAME="end" VALUE="<?= base64_encode(serialize($end)); ?>">
        <INPUT TYPE="hidden" NAME="length" VALUE="<?= base64_encode(serialize($length)); ?>">

        <input type="submit" value="答え" class="button">
       </form></td>
       <td><input type="button" value="印刷" class="noprint" onclick="window.print();"/></td>
       </tr>
       </table>
       </div>
        
       <table class="border">
           　　<caption><?php print 'duo単語　範囲　'.$start.'~'.$end.'まで　　出題数　'.$length ?><?php print '     点数　 /'.$length?></caption>
               <tr class="border">
                   <th class="border">番号</th>
                   <th class="border">英単語</th>
                   <th class="border">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp日本語訳&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
               </tr>
           
<?php       foreach ($words as $word) { ?>
               <tr class="border">
                   
                   <td class="border"> <?php print h($word['number']); ?></td>
                   <td class="border"> <?php print h($word['word']); ?></td>
                   <td class="border"></td>
                   
               </tr>
<?php    } ?>
          </table>
           
          
   </section>
</body>
</html>
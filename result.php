<?php
$host   = 'mysql'; 
$user   = 'root';  
$passwd = 'root';   
$dbname = 'practice';
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
            $err_msg[] = '半角英数字かつ文字数は6文字以上で入力してください。';
        }

    $end=0;
    if(isset($_POST['end'])){
            $end=$_POST['end'];
        }
    if (preg_match('/^[0-9]+$/', $end) === 0) {
            $err_msg[] = '半角英数字かつ文字数は6文字以上で入力してください。';
        }

    $length=0;
    if(isset($_POST['length'])){
            $length=$_POST['length'];
        }
    if (preg_match('/^[0-9]+$/', $length) === 0) {
            $err_msg[] = '半角英数字かつ文字数は6文字以上で入力してください。';
        }
    $view=$end-$start;
    $word_start=$start-1;
    $limit  = ' limit ' . $word_start . ',' . $view;
    if (count($err_msg)===0){
        if($link!==FALSE){
            $sql='SELECT * FROM words order by number'.$limit;
            var_dump($sql);
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
              mysqli_free_result($result);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>単語テスト</title>
</head>
<body>
<?php  foreach ($err_msg as $err){ ?>
        <li><?php print $err; ?></li>
 <?php } ?>
<section>
       <h2>単語テスト</h2>
       
           <table>
               <tr>
                   <th>番号</th>
                   <th>英単語</th>
                   <th>日本語訳</th>
               </tr>
           
<?php       foreach ($words as $word) { ?>
               <tr>
                   
                   <td><?php print $word['number']; ?></td>
                   <td><?php print $word['word']; ?></td>
                   <td><?php print $word['translation']; ?></td>
                   
               </tr>
<?php    } ?>
          </table>
       
   </section>
</body>
</html>
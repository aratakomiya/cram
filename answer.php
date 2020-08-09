<?php

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
    <title>答え</title>
    <style>
     table,th,td{
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
     }
     .top{
         margin:0 40%;
     }
    
    </style>
</head>
<body>
  <section>
   <div class="top">
    　　<form action="problem.php" method="post">
            <INPUT TYPE="hidden" NAME="answer" VALUE="<?= base64_encode(serialize($words)); ?>">
            <INPUT TYPE="hidden" NAME="start" VALUE="<?= base64_encode(serialize($start)); ?>">
            <INPUT TYPE="hidden" NAME="end" VALUE="<?= base64_encode(serialize($end)); ?>">
            <INPUT TYPE="hidden" NAME="length" VALUE="<?= base64_encode(serialize($length)); ?>">
            <INPUT TYPE="hidden" NAME="return" >

            <input type="submit" value="問題">
    </form>
   </div>
　　　<table>
        <caption><?php print '範囲　'.$start.'~'.$end.'まで　　出題数　'.$length ?></caption>
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
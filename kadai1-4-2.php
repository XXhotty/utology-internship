<?php

$fp = fopen("file-sample.txt", "w") or die("ファイルが開けないよぉ！");
 
// ファイルへ書き込み
fwrite($fp, "==== ==== ==== ==== ====\n") or die("ファイルに書き込めない！");
fwrite($fp, "ファイルへの追記サンプル");
fwrite($fp, "==== ==== ==== ==== ====\n");
 
// ファイルを閉じる
fclose($fp);
 
?>
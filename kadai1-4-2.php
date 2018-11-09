<?php
// ファイルオープン
$fp = fopen("file-sample.txt", "r") or die("ファイルが開けないよぉ！");
 
// ファイルへ書き込み
fwrite($fp, "==== ==== ==== ==== ====\n");
fwrite($fp,"as");
fwrite($fp, "==== ==== ==== ==== ====\n");
-
// 読み込んだファイルを出力
while( !feof($fp) ) {
  echo fgets($fp);
}
 
// ファイルクローズ
fclose($fp);
?>
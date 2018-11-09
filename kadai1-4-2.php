<?php
// ファイルオープン
$fp = fopen("file-sample.txt", "r") or die("ファイルが開けないよぉ！");
 
// 読み込んだファイルを出力
while( !feof($fp) ) {
  echo fgets($fp);
}
 
// ファイルクローズ
fclose($fp);
?>
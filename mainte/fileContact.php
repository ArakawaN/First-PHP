<?php

$contactFile =  '.contact.dat';

// ファイル丸ごと読み込み
$fileContents = file_get_contents($contactFile);

// echo $fileContents;

// ファイルに書き込み（上書き）

// file_put_contents($contactFile, 'テストです');


// ファイルに書き込み（追記）

// $addtext = 'テストです' . "\n";

// file_put_contents($contactFile, $addtext, FILE_APPEND);

// 配列 file , 区切る explode

$allData = file($contactFile);

foreach ($allData as $lineData) {
    $lines = explode(',', $lineData);
    echo $lines[0] . '<br>';
    echo $lines[1] . '<br>';
    echo $lines[2] . '<br>';
}

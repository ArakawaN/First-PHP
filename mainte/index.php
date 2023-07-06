<?php

require 'db_connection.php';

// <!-- ユーザー入力なし -->
// <!-- sql -->
// $sql = 'select * from contacts where id = 3';
// $stmt = $pdo->query($sql);

// $result = $stmt->fetchall();

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

// ユーザー入力あり prepare bind excute
// 名前付きプレース
$sql = 'select * from contacts where id = :id';
$stmt = $pdo->prepare($sql); //プリペアードステイトメン
// :idと紐付けるbind
$stmt->bindValue('id', 3, PDO::PARAM_INT); //紐付け
$stmt->execute(); //実行

$result = $stmt->fetchall();

echo '<pre>';
var_dump($result);
echo '</pre>';

// トランザクション　まとまって処理　 beginTransaction,commit
$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', 2, PDO::PARAM_INT);
    $stmt->execute();

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack(); //変更のキャンセル
}

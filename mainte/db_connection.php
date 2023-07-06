<?php

const DB_HOST = $_ENV['DB_HOST'];

const DB_USER = $_ENV['DB_USER'];

const DB_PASSWORD = $ENV['DB_PASSWORD'];


//例外処理

try {
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    echo '接続成功';
} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage() . "\n";
    exit();
}

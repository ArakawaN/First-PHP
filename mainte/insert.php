<?php



//入力　DB保存　prepare execute
// $_POST['your_name'];

function insertContact($req)
{

    require 'db_connection.php';

    $params = [
        'id' => null,
        'your_name' => $req['your_name'],
        'email' => $req['email'],
        'url' => $req['url'],
        'gender' => $req['gender'],
        'age' => $req['age'],
        'contact' => $req['contact'],
        'created_at' => null
    ];


    // $params = [
    //     'id' => null,
    //     'your_name' => '名前',
    //     'email' => 'test@text.com',
    //     'url' => 'https://test.com',
    //     'gender' => '1',
    //     'age' => '1',
    //     'contact' => 'asap',
    //     'created_at' => null
    // ];
    $count = 0;
    $colums = '';
    $values = '';

    // array_keys()連想配列の右側を持って来れる
    foreach (array_keys($params) as $key) {
        if ($count++ > 0) {
            // 0より大きかったらカンマを付けて区切っていく
            $colums .= ',';
            $values .= ',';
        }
        $colums .= $key;
        $values .= ':' . $key; //名前付きプレイスホルダー
    }

    $sql = 'insert into contacts (' . $colums . ')values(' . $values . ')';

    // var_dump($sql);

    // 全部同じ型の時はbindなし
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
};
